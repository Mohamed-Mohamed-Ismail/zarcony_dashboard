<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'card_number' => 'required|numeric|digits:14',
            'expiry_date' => 'required',
            'CVC' => 'required|digits:3',
            'card_holder_name' => 'required|string',
            'recipient_id' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
        ];
    }
}
