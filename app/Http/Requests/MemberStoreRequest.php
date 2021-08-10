<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberStoreRequest extends FormRequest
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
            'member_name' => ['required'],
            'member_address' => ['required'],
            'member_phone' => ['required', 'numeric', 'unique:members,member_phone'], 
        ];
    }

    public function messages()
    {
        return [
            'member_name.required' => 'A member name is required',
            'member_address.required' => 'Member address is required',
            'member_phone.required' =>  'Member phone is required',
            'member_phone.numeric' => 'Member phone must be numerical',
            'member_phone.unique' => 'Member phone is exist'
        ];
    }
}
