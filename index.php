<?php
    error_reporting(E_ALL);

    ini_set('ignore_repeated_errors', TRUE);

    ini_set('display_errors', TRUE);

    ini_set('log_errors', true);

    ini_set("error_log", 'C:\laragon\www\Proyecto-INRLP\php-error.log');
    error_log("Inicio de aplicación web");

    require_once 'libs/database.php';
    require_once 'clases/errormessages.php';
    require_once 'clases/successmessages.php';
    require_once 'libs/controller.php';
    require_once 'clases/sessioncontroller.php';
    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'config/config.php';
    require_once 'libs/app.php';

    $app = new App();
?>