<?php namespace App\Controllers;

use App\Models\ajaxModel;
use Dotenv\Dotenv;

    require_once '../vendor/autoload.php';

    date_default_timezone_set('America/Lima');
    @ob_start();
    session_start();

    $app = new ajaxModel();
    $data = $app->getUsuarioBy('1600505505', 'cedula');
    echo(json_encode($data));
   
    