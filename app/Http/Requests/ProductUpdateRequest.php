<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'product_name' => ['required', Rule::unique('products', 'product_id')->ignore($this->product->product_id, 'product_id')],
            'product_price' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'product_name.unique' => 'The product name is exist',
            'product_price.numeric' => 'The product price must be a valid number'
        ];
    }
}
