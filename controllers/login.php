<?php
    class Login extends SessionController{
        function __construct()
        {
            parent::__construct();
            error_log('Login::construct-> Inicio de login');
        }

        function render(){
            $this->view->render('login/index');
        }

        function authenticate(){
            if( $this->existPOST(['username', 'password']) ){
                $username = $this->getPost('username');
                $password = $this->getPost('password');
    
                //validate data
                if($username == '' || empty($username) || $password == '' || empty($password)){
                    //$this->errorAtLogin('Campos vacios');
                    error_log('Login::authenticate() empty');
                    $this->redirect('', ['error' => ErrorMessages::USUARIO_LOGIN_USUARIO_VACIO]);
                    return;
                }
                // si el login es exitoso regresa solo el ID del usuario
                
                $user = $this->model->login($username, $password);
    
                if($user != NULL){
                    // inicializa el proceso de las sesiones
                    error_log('Login::authenticate() passed');    
                    $this->initialize($user);
                }else{
                    //error al registrar, que intente de nuevo
                    //$this->errorAtLogin('Nombre de usuario y/o password incorrecto');
                    error_log('Login::authenticate() username and/or password wrong');
                    $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN]);
                    return;
                }
            }else{
                // error, cargar vista con errores
                //$this->errorAtLogin('Error al procesar solicitud');
                error_log('Login::authenticate() error with params');
                $this->redirect('', ['error' => ErrorMessages::ERROR_LOGIN]);
            }
        }
    }
?>