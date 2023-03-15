<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaNombre implements Rule
{


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return ($this->isValid($value)) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ingrese un nombre válido.';
    }


    private function isValid($nombre)
    {
        $expre = "/^(([a-zA-Z|ñ|Ñ|á|é|í|ó|ú|Á|É|Í|Ó|Ú]+)(\s)?){0,3}$/";

        if(preg_match($expre , $nombre)){
            return true;
        }else{
            return false;
        }
    }
}
