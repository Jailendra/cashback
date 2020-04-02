<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBankPutRequest extends FormRequest
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
    public function rules() {
        return [
            'bank_name' => 'bail|required|string||min:4|max:50',
            'branch_name' => 'bail|required|string|min:4|max:50',
            'account_name' => 'bail|required|string|min:4|max:50',
            'account_number' => 'bail|required|string|min:4|max:50',
            'swift' => 'bail|required|string|min:4|max:50',
            'iban' => 'bail|required|string|min:4|max:50'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'required' => 'The :attribute field is required!'
        ];
    }
}
