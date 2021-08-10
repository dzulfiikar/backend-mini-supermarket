<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'product_name' => ['sometimes', 'required', 'unique:products,product_name'],
            'product_stock' => ['sometimes', 'required', 'numeric'],
            'product_price' => ['sometimes', 'required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'product_name.unique' => 'The product name is exist',
            'product_stock.numeric' => 'The product stock must be a valid number',
            'product_price.numeric' => 'The product price must be a valid number'
        ];
    }
}
