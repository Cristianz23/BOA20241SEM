<?php

require_once 'models/usermodel.php';

class Registro extends SessionController{

    function __construct(){
        parent::__construct();
    }

    function render(){
        $this->view->render('login/registro', []);
    }


    function nuevoUsuario(){
        if($this->existPOST(['username', 'password'])){
            
            $username = $this->getPost('username');
            $password = $this->getPost('password');
        
            if($username == '' || empty($username) || $password == '' || empty($password)){
                // error al validar datos
                //$this->errorAtSignup('Campos vacios');
                $this->redirect('registro', ['error' => ErrorMessages::ERROR_USUARIO_VACIO]);
            }
            $user = new UserModel();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole("user");

            if($user->exists($username)){
                //$this->errorAtSignup('Error al registrar el usuario. Elige un nombre de usuario diferente');
                $this->redirect('registro', ['error' => ErrorMessages::USUARIO_EXISTE]);
                //return;
            }else if($user->save()){
                //$this->view->render('login/index');
                $this->redirect('', ['success' => SuccessMessages::USUARIOCREADO]);
            }else{
                /* $this->errorAtSignup('Error al registrar el usuario. Inténtalo más tarde');
                return; */
                $this->redirect('registro', ['error' => ErrorMessages::ERROR_REGISTRO]);
            }
        }else{
            // error, cargar vista con errores
            $this->redirect('registro', ['error' => ErrorMessages::ERROR_REGISTRO]);
        }
    }

}

?>