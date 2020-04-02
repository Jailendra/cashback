<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessCashback extends FormRequest
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
            'ids' => 'bail|required|array|min:1',
            'ids.*' => 'bail|required|exists:commission_received,id,disburse,false,request_date,!NULL'
        ];
    }

    protected function validationData() {
        return [
            'ids' => $this->get('ids') ? explode (',', $this->get('ids')) : null
        ];
    }

    public function messages () {
        return [
            'required' => 'Select at least a commission.'
        ];
    }
}
