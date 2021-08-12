<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportShowStocksProfitRequest extends FormRequest
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
            'profit_date' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'profit_date.required' => 'the :attribute is required',
            'profit_date.date' => 'the :attribute must be a valid date',
        ];
    }
}
