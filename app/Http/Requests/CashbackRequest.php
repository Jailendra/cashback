<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashbackRequest extends FormRequest
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
            'mode' => 'bail|required|in:bank,bitcoin'
        ];
    }

    public function messages () {
        return [
            'in' => 'The :attribute must be one of the values: :values.'
        ];
    }
}
