<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => ['required', 'unique:products,product_name'],
            'product_stock' => ['required', 'numeric'],
            'product_price' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'A product name is required',
            'product_name.unique' => 'The product name is exist',
            'product_stock.required' => 'The product must have stock',
            'product_stock.numeric' => 'The product stock must be a valid number',
            'product_price.required' => 'The product must have price',
            'product_price.numeric' => 'The product price must be a valid number'
        ];
    }
}
