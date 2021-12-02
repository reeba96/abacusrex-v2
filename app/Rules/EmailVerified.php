<?php

namespace App\Rules;

use Modules\Access\Entities\User;
use Illuminate\Contracts\Validation\Rule;

class EmailVerified implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $user = User::where('email',$value)->first();
        if ( $user && $user->confirmed == 1) 
            return true;
        else 
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  trans('translate.account_not_activated');
    }
}
