<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionMemberAndVoucherRequest extends FormRequest
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
            'total_price' => ['required', 'numeric', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'total_price.required' => 'Total price is required',
            'total_price.numeric' => 'Data must be in numerical',
            'total_price.min' => 'Price must not be 0'
        ];
    }
}
