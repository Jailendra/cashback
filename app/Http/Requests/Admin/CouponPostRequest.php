<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'brand' => 'bail|required|string|max:100',
            'callback_url' => ['bail', 'required', 'string', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'affiliate_url' => ['bail', 'required', 'string', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
            'offer_type' => 'bail|required|string|in:free_shipping,discount,cashback',
            'discount' => 'bail|required',
            'image' => 'bail|required|image|mimes:jpeg,jpg,png|min:1|max:500',
            'start_date' => 'bail|required|date_format:Y-m-d',
            'end_date' => 'bail|required|date_format:Y-m-d'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'required' => ':attribute field is required!',
            'regex' => ':attribute must be a valid URL. ex: http://example.com/route?params',
            'in' => 'The :attribute must have one of the value :values'
        ];
    }
}
