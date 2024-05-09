<?php

class SuccessMessages{

    const PRUEBA = "e89d507f8a4352b078784cf9709f3586";
    const USUARIOCREADO = "usrcrd0";

    private $successList = [];
    public function __construct()
    {
        $this->successList = 
        [
            SuccessMessages::PRUEBA => 'ya existe categoria',
            SuccessMessages::USUARIOCREADO => 'Usuario Creado de manera exitosa'
        ];
    }

    public function get($hash){
        return $this->successList[$hash];
    }

    public function existKey($key) {
        if (array_key_exists($key, $this->successList)){
            return true;
        } else {
            return false;
        }
    }
}


?>