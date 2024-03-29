<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreInventoryRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Inventory;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
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
            'data' => Products::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $product = Products::create($data);
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 201);
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
    public function show(Products $product)
    {
        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Products $product)
    {
        $update_data = $request->validated();
        try {
            $product->product_name = $update_data['product_name'];
            $product->product_price = $update_data['product_price'];
            $product->save();
            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Unknown request',
            'data' => []
        ], 400);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        try {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Product has been deleted',
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
