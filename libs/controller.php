<?php
//CONTROLADOR BASE
    class Controller {
        protected $view;
    
        // Define la propiedad $model
        protected $model;
        function __construct()
        {
            $this -> view = new View();
        }

        function loadModel($model){
            $url = 'models/' . $model . 'model.php';

            if (file_exists($url)) {
                require_once $url;

                $modelName = $model.'Model';
                $this -> model = new $modelName();
            }
        }

        function existPOST($params){
            foreach ($params as $param){
                if (!isset($_POST[$param])){
                    error_log('CONTROLLER::existPost => No existe el parametro ' . $param);
                    return false;
                }
            }

            return true;
        }

        function existGET($params){
            foreach ($params as $param){
                if (!isset($_GET[$param])){
                    error_log('CONTROLLER::existGET => No existe el parametro ' . $param);
                    return false;
                }
            }

            return true;
        }

        function getGet($name){
            return $_GET[$name];
        }

        function getPost($name){
            return $_POST[$name];
        }

        function redirect($ruta, $mensajes)
        {
            $data = [];
            $params = '';

            foreach ($mensajes as $key => $mensaje){
                array_push($data, $key . '=' . $mensaje);
            }

            $params = join('&', $data);
            // ?nombre=Nombre&apellido=Apellido

            if($params != ''){
                $params = '?' . $params;
            }

            header('Location: ' . constant('URL') . '/' . $ruta .$params);
        }
    }

?>