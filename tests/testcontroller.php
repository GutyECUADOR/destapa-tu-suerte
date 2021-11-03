<?php namespace App\Controllers;

use Dotenv\Dotenv;
use App\Controllers\AjaxController;

    require_once '../vendor/autoload.php';

    date_default_timezone_set('America/Lima');
    @ob_start();
    session_start();
    $dotenv = Dotenv::createImmutable('../');
    $dotenv->load();

    $controller = new AjaxController();
    $usuario = new \stdClass;
    $repsonse = $controller->verify_code($usuario);
    echo($repsonse);
   
    