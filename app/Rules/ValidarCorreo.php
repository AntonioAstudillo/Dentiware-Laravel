<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class ValidarCorreo implements Rule
{
    private $tipo;
    private $message;

    public function __construct($tipo)
    {
        $this->tipo = $tipo;
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

        //Comprobamos que sea un correo valido, si asi lo fuera, pasamos a la siguiente capa de validación la cual es comprobar si el correo ya se encuentra
        //registrado
        if($this->isValid($value))
        {
            //Comprobamos si ya existe
            if(!$this->checkEmail($value))
            {
                $this->message = 'El correo ya se encuentra registrado';
                return false;
            }
            else
            {
                return true;
            }
        }else{
            $this->message = "El correo es inválido";
            return false;
        }
    }

    /**
     * Verificamos si el correo enviado, ya se encuentra registrado
     * Este metodo recibe un string correspondiente al correo que queremos comprobar
     */
    private function checkEmail(String $correo)
    {
        $results = DB::select('select * from persona where correo = ? and tipo = ?', [$correo , $this->tipo]);

        $count = count($results);

        return ($count > 0)? false : true;
    }


    private function isValid(String $correo)
    {
        $expresion = "/^(([^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+(\.[^<>()[\]\.,&%$#!=?¡¿;:\s@\"]+)*)|(\".+\")){2,63}@(hotmail.com|gmail.com|uteg.edu.mx|outlook.com|dentiware.com)$/";

        if(preg_match($expresion , $correo)){
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
        return $this->message;
    }


    public function setMessage(String $valor)
    {
        $this->message = $valor;
    }
}
