<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
        ];
    }

    public function messages(){
        return [
            'email.required' => 'An email is required',
            'email.email' => 'Must be a valid email',
            'password.required' => 'Password is required',
            'password.min' => 'Password length must be minimal of 8 characters',
            'password.regex' => 'Password must not contain other than alphabet, numeric, symbols',
        ];
    }
}
