<?php

namespace App\Rules\Balances;

use App\Http\Models\Cnr\UserDetails;
use Illuminate\Contracts\Validation\Rule;

class AmountCheck implements Rule
{
    protected $attributes;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userDetail = UserDetails::with('balance')->where('phone_number', $this->attributes['phone_number'])->firstOrFail();

        if ($userDetail->balance->amount >= $value) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.balances.amount_check');
    }
}
