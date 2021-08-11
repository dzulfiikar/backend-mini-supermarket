<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionMemberAndVoucherRequest;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Member;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Transaction::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionStoreRequest $request)
    {
        $store_data = $request->validated();
        $transaction = Transaction::create([
            'user_id' => $store_data['user_id'],
            'member_id' => $store_data['member_id'],
            'voucher_id' => $store_data['voucher_id'],
            'total_price' => $store_data['total_price']
        ]);

        $fifoResponse = $this->inputItemsToCartAndUpdateStockByFIFO($store_data['items'], $transaction->transaction_id);
        $transaction['items'] = $fifoResponse;
        return response()->json([
            'status' => 'success',
            'data' => $transaction,
            ], 201);
        // try {
        //     $transaction = Transaction::create([
        //         'user_id' => $store_data['user_id'],
        //         'member_id' => $store_data['member_id'],
        //         'voucher_id' => $store_data['voucher_id'],
        //         'total_price' => $store_data['total_price']
        //     ]);

        //     $fifoResponse = $this->inputItemsToCartAndUpdateStockByFIFO($store_data['items'], $transaction->transaction_id);
        //     $transaction['items'] = $fifoResponse;
        //     return response()->json([
        //         'status' => 'success',
        //         'data' => $transaction,
        //         ], 201);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'status' => 'failed',
        //         'data' => []
        //     ], 400);
        // }
    }

    private function  inputItemsToCartAndUpdateStockByFIFO($items, $transaction_id){
        $return_items = [];
        // loop array items
        foreach($items as $item){
            // find all stock in inventory
            $inventories = Inventory::where('product_id', $item['product_id'])->where('product_stock', '>', '0')->orderBy('created_at')->get();
            $stock_all = Inventory::where('product_id', $item['product_id'])->where('product_stock', '>', '0')->orderBy('created_at')->get('product_stock')->sum('product_stock');
            
            // get post qty
            $qty = $item['qty'];
            if($qty <= $stock_all){
                // loop all inventory
                foreach($inventories as $inventory){
                    // get inventory info
                    $date = $inventory['created_at'];
                    $stock = $inventory['product_stock'];
                    
                    // if qty > 0
                    if($qty > 0){

                        // create temporary data
                        $temp = $qty;

                        // reduce qty by current stock
                        $qty = $qty - $stock;

                        // if qty exceeds 0, set stock_update to 0 else then $stock - $temp
                        if($qty > 0){
                            $stock_update = 0;
                        }else {
                            $stock_update = $stock - $temp;
                        }

                        Inventory::where('product_id', $inventory['product_id'])
                        ->where('created_at', $date)
                        ->update(['product_stock' => $stock_update]);
                    }
                }

                $cart = Cart::create([
                    'transaction_id' => $transaction_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['qty']
                ]);

                $product_info = Products::where('product_id', $cart->product_id)->get('product_name')->first();
                array_push($return_items, [
                    'product_id' => $cart->product_id,
                    'product_name' => $product_info->product_name,
                    'quantity' => $cart->quantity
                ]);
            }else {
                // if qty exceeds stock
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Qty exceeds inventory',
                    'data' => $item
                ], 400);
            }
        }
        return $return_items;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    public function showProduct(Products $product){
        $product_stock = $product->inventory()->get('product_stock')->sum('product_stock');
        return response()->json([
            'status' => 'success',
            'data' => [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'product_stock' => $product_stock
            ]
        ], 200);
    }

    public function getMemberAndVoucher(TransactionMemberAndVoucherRequest $request, Member $member){
        $post_data = $request->validated();
        $available_points = $this->getAccumulatedPointsAndAvailableVouchers($post_data['total_price']);
        return response()->json([
            'status' => 'success',
            'data' => [
                'member_id' => $member->member_id,
                'member_name' => $member->member_name,
                'available_points' => $available_points,
                'available_vouchers' => Voucher::where('voucher_point', '<', $available_points)->get(),
            ],
        ], 200);
    }

    private function getAccumulatedPointsAndAvailableVouchers($total_price){
        $rule_point_1 = 100000;
        $rule_point_2 = 200000;
        $rule_point_3 = 350000;

        $accumulated_points = 0;
        $remaining_price = $total_price;

        if($remaining_price >= $rule_point_1){
            $accumulated_points = $accumulated_points + 10;
            $remaining_price = $remaining_price - $rule_point_1;
        }
        
        if($remaining_price >= $rule_point_2){
            $accumulated_points = $accumulated_points + 40;
            $remaining_price = $remaining_price - $rule_point_2;
        }
        if($remaining_price >= $rule_point_3){
            $accumulated_points = $accumulated_points + (($remaining_price / 10000) * 3);
        }

        return $accumulated_points;
    }

}
