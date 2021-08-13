<?php

namespace App\Http\Requests;

use App\Rules\ProductQuantity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TransactionStoreRequest extends FormRequest
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

    protected $validatedData;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'member_id' => ['present','nullable', 'exists:members,member_id'],
            'voucher_id' => ['present', 'nullable','exists:vouchers,voucher_id'],
            'accumulated_points' => ['required'],
            'total_price' => ['required', 'numeric'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required',  'numeric', 'exists:products,product_id'],
            'items.*.qty' => ['required', 'numeric', 'min:1', new ProductQuantity('items.*.product_id')],
            'items.*.price_per_qty' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User id is required',
            'user_id.exists' => 'User not exists',
            'member_id.present' => 'Member id field is required',
            'member_id.exists' => 'Member id not exists',
            'voucher_id.present' => 'Voucher id field is required',
            'voucher_id.exists' => 'Voucher id not exists',
            'total_price.required' => 'Total price is required',
            'total_price.numeric' => 'Total price must be numeric',
            'items.required' => 'Items field is required',
            'items.array' => 'Items must be an array',
            'items.min' => 'must have a minimal of 1 item',
            'items.*.product_id.required' => 'Product id is required on items array',
            'items.*.product_id.numeric' => 'Product id must be a number',
            'items.*.product_id.exists' => 'Product id does not exist',
            'items.*.qty.required' => 'Product qty is required',
            'items.*.qty.numeric' => 'Product qty must be a number',
            'items.*.qty.min' => 'Product qty must not have 0 value',
            'items.*.price_per_qty.required' => 'Product price is required',
            'items.*.price_per_qty.numeric' => 'Product price must be a number',
        ];
    }

    public function validated()
    {
        return $this->validatedData ?: $this->validatedData = parent::validated();
    }
}
