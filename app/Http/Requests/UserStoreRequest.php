<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'password_confirmation' => ['required', 'same:password'],
            'roles' => ['required', Rule::in(['admin', 'kasir', 'gudang'])]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'email.required' => 'An email is required',
            'email.email' => 'Must be a valid email',
            'email.unique' => 'Email has been taken',
            'password.required' => 'A Password is required',
            'password.confirmed' => 'Password must match',
            'password.min' => 'Password length must be minimal of 8 characters',
            'password.regex' => 'Password must not contain other than alphabet, numeric, symbols',
            'password_confirmation.required' => 'Password confirmation must not empty',
            'password_confirmation' => 'Password must match',
            'roles.required' => 'A role is required',
            'roles.in' => 'Role is unknown'
        ];
    }

}
