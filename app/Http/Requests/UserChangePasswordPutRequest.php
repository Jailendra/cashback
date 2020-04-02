<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserChangePasswordPutRequest extends FormRequest
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
    public function rules(Request $request) {
        return [
            'old_password' => 'bail|required',
            'new_password'=>'bail|required',
            'confirm_password'=>'bail|required|same:new_password'
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

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if ( !app('hash')->check($this->old_password, $this->user()->password) ) {
                $validator->errors()->add('old_password', 'Your current password is incorrect.');
            }
        });
        return;
    }
}
