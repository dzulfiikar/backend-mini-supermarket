<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherStoreRequest extends FormRequest
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
            'voucher_name' => ['required', 'unique:vouchers,voucher_name'],
            'voucher_discount' => ['present', 'numeric'],
            'voucher_value' => ['required', 'numeric'],
            'voucher_point' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'voucher_name.required' => 'Voucher name is required',
            'voucher_name.unique' => 'Voucher name exists',
            'voucher_discount.present' => 'Voucher value field is required',
            'voucher_discount.numeric' => 'Voucher discount must be numeric',
            'voucher_value.required' => 'Voucher value is required',
            'voucher_value.numeric' => 'Voucher value must be numeric',
            'voucher_point.required' => 'Voucher point is required',
            'voucher_point.numeric' => 'Voucher point must be numeric'
        ];
    }
}
