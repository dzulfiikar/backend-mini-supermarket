<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherStoreRequest;
use App\Http\Requests\VoucherUpdateRequest;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;

class VoucherController extends Controller
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
            'data' => Voucher::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherStoreRequest $request)
    {
        $store_data = $request->validated();
        try {
            $data = Voucher::create($store_data);
            return response()->json([
                'status' => 'success',
                'data' => $data
            ],201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        return response()->json([
            'status' => 'success',
            'data' => $voucher
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherUpdateRequest $request, Voucher $voucher)
    {
        $update_data = $request->validated();
        try {
            $voucher->voucher_name = $update_data['voucher_name'];
            $voucher->voucher_discount = $update_data['voucher_discount'];
            $voucher->voucher_value = $update_data['voucher_value'];
            $voucher->voucher_point = $update_data['voucher_point'];
            $voucher->save();

            return response()->json([
                'status' => 'success',
                'data' => $voucher
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        try {
            $voucher->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Voucher has been deleted',
                'data' => []
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
    }
}
