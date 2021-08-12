<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryStoreRequest extends FormRequest
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
            'product_stock' => ['required', 'numeric'],
            'created_at' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'product_stock.required' => 'Product stock is required',
            'product_stock.numeric' => 'Must be a valid numerical',
            'created_at.required' => 'Created date is required',
            'created_at.date' => 'Created date field must be a valid date',
        ];
    }
}
