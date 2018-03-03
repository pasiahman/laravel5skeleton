<?php

namespace App\Http\Requests\API\Cnr\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'reference_number' => ['required', 'between:0,50'],
            'total' => ['required', 'integer', 'digits_between:0,20'],
            'cnr_cash' => [
                'required', 'integer', 'digits_between:0,20',
                new \App\Rules\Balances\AmountCheck($this->input()),
            ],
            'phone_number' => [
                'required', 'between:0,50',
                new \App\Rules\UserDetails\PhoneNumberExist($this->input()),
            ],
            'verification_code' => [
                'required', 'between:0,10',
                new \App\Rules\UserDetails\PhoneNumberVerificationCodeCheck($this->input()),
            ],
        ];
    }
}
