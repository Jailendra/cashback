<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertiserDetailRequest extends FormRequest
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
            'advertiser_id' => 'bail|required|int|exists:advertisers,advertiser_id,deleted_at,NULL'
        ];
    }

    protected function validationData() {
        return [
            'advertiser_id' => $this->route('advertiserId')
        ];
    }
}
