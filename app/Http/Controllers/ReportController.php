<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportShowStocksProfitRequest;
use App\Http\Requests\ReportShowStocksRequest;
use App\Http\Requests\ReportShowTransactionRequest;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Products;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showTransactions(ReportShowTransactionRequest $request){
        $show_request = $request->validated();

        if($show_request['order_type'] == 'date'){
            $transactions = Transaction::whereRaw('DATE(created_at) = ?', [$show_request['order_date']])->get();
        }

        if($show_request['order_type'] == 'month'){
            $parse_date = Carbon::parse($show_request['order_date']);
            $start_month = $parse_date->startOfMonth()->format('Y-m-d H:i:s');
            $end_month = $parse_date->endOfMonth()->format('Y-m-d H:i:s');
            $transactions = Transaction::whereBetween('created_at', [$start_month, $end_month])->get();
        }
    
        return response()->json([
            'status' => 'success',
            'data' => $transactions
        ], 200);
    }

    public function showStocksByMonth(ReportShowStocksRequest $request){
        $show_request = $request->validated();
        $parse_date = Carbon::parse($show_request['stock_date']);
        $start_month = $parse_date->startOfMonth()->format('Y-m-d H:i:s');
        $end_month = $parse_date->endOfMonth()->format('Y-m-d H:i:s');

        $clean_data = array();
        $products = Products::orderBy('product_id')->get(['product_id', 'product_name']);
        
        foreach($products as $product){
            $total_value = 0;
            $inventories = Inventory::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get();
            
            foreach($inventories as $inventory){
                $total_value = $total_value + ($inventory->product_price * $inventory->product_stock);
            }
            $product_stocks = Inventory::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get('product_stock')->sum('product_stock');
            
            $clean_data[] = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'total_stocks' => $product_stocks,
                'total_value' => $total_value
            ];
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $clean_data
        ], 200);
    }

    public function showStocksProfit(ReportShowStocksProfitRequest $request){
        $show_request = $request->validated();
        $parse_date = Carbon::parse($show_request['profit_date']);
        $start_month = $parse_date->startOfMonth()->format('Y-m-d H:i:s');
        $end_month = $parse_date->endOfMonth()->format('Y-m-d H:i:s');

        $clean_data = array();
        $products = Products::orderBy('product_id')->get(['product_id', 'product_name']);

        foreach($products as $product){
            $total_value = 0;
            $total_sold_value = 0;
            
            // get all inventory data
            $inventories = Inventory::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get();
            foreach($inventories as $inventory){
                $total_value = $total_value + ($inventory->product_price * $inventory->product_stock);
            }

            // get total product stocks in that month
            $product_stocks = Inventory::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get('product_stock')->sum('product_stock');
            
            // get all cart data
            $carts = Cart::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get(); 
            foreach($carts as $cart){
                $total_sold_value = $total_sold_value + ($cart->quantity * $cart->price_per_qty);
            }
            // get sold stocks
            $sold_stocks = Cart::where('product_id', $product->product_id)->whereBetween('created_at', [$start_month, $end_month])->get('quantity')->sum('quantity');

            $clean_data[] = [
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'total_stocks' => $product_stocks,
                'total_value' => $total_value,
                'sold_stocks' => $sold_stocks,
                'total_sold_value' => $total_sold_value,
                'profit' => ($total_sold_value - $total_value)
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => $clean_data
        ], 200);
    }
}
