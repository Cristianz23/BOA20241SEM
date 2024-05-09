<?php

class ErrorMessages{

    // ERROR_CONTROLLER_METHOD_ACTION CIFRADO: MD5 URL: https://www.infranetworking.com/md5
    const PRUEBA = "e89d507f8a4352b078784cf9709f3586";
    const ERROR_REGISTRO = "errorregistro";
    const ERROR_USUARIO_VACIO = "EMPTY";
    const USUARIO_EXISTE = "usrexst";
    const USUARIO_LOGIN_USUARIO_VACIO = "lgerr0rusremty";
    const ERROR_LOGIN_AUTENTICACION = "elgathnc";
    const ERROR_LOGIN = "r0rlgn";
    const ERROR_EXPENSES_NEWEXPENSE_EMPTY = "errrexpnsnempty";

    private $errorList = [];
    public function __construct()
    {
        $this->errorList = 
        [
            ErrorMessages::PRUEBA => 'Ejemplo de error',
            ErrorMessages::ERROR_REGISTRO => 'Error al registrarse',
            ErrorMessages::ERROR_USUARIO_VACIO => 'Llenar campos',
            ErrorMessages::USUARIO_EXISTE => 'Ese nombre de usuario ya existe',
            ErrorMessages::USUARIO_LOGIN_USUARIO_VACIO => 'Los campos son obligatorios',
            ErrorMessages::ERROR_LOGIN_AUTENTICACION => 'Usuario o contraseña incorrecta',
            ErrorMessages::ERROR_LOGIN => 'Error de autenticación de información',
            ErrorMessages::ERROR_EXPENSES_NEWEXPENSE_EMPTY => 'Error de autenticación de información',
        ];
    }

    public function get($hash){
        return $this->errorList[$hash];
    }

    public function existKey($key) {
        if (array_key_exists($key, $this->errorList)){
            return true;
        } else {
            return false;
        }
    }
}


?>