<?php

require_once 'controllers/errores.php';

class App{
    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "";
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        // SI NO EXISTE REDIRIGE AL LOGIN --> CAMBIAR A INDEX AL FINAL
        if (empty($url[0])){
            error_log('APP::construct-> no hay controlador especificado');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';

        if(file_exists($archivoController)){
            require_once $archivoController;

            $controller = new $url[0];
            $controller -> loadModel($url[0]);

            if (isset($url[1])){
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        //numero de parametros 
                        $nparam = count($url) - 2; //ya que el primer parametro es el nombre controlador y el segundo es el metodo
                        $params = [];

                        for ($i = 0; $i< $nparam; $i++){
                            array_push($params, $url[$i] + 2);
                        }

                        $controller -> {$url[1]}($params);
                    } else {
                        // no tiene parametros, se manda a llamar el metodo
                        $controller -> {$url[1]}();
                    }
                } else {
                    //Error, no existe el metodo
                    $controller = new Errores();
                    $controller -> render();
                }
            } else{
                $controller -> render();
            }
        } else {
            // no existe el archivo, 404
            $controller = new Errores();
            $controller -> render();
        }
    }
}

?>