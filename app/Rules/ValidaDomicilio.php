<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaDomicilio implements Rule
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
        $expre = '/^([a-z|Ñ|ñ|A-Z|á|é|í|ó|ú|Á|É|Í|Ó|Ú|0-9#,]\s?)+$/';

        if(preg_match($expre , $value)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Domicilio no válido.';
    }
}
