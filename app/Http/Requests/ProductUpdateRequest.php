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
        $id = $this->route('id');
        return [
            'product_name' => ['required', 'unique:products,product_name,'.$id.',product_id'],
            'product_stock' => ['required', 'numeric'],
            'product_price' => ['required', 'numeric']
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
