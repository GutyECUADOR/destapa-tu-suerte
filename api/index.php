<?php
use App\Controllers\AjaxController;
use Dotenv\Dotenv;

@ob_start();
date_default_timezone_set('America/Lima');
header('Content-Type: application/json');

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

  /* Cuerpo del API */

  try{
    $ajaxController = new AjaxController();

    if (isset($_GET["action"])) {
      $HTTPaction = $_GET["action"];
    }else{
      throw new Exception("Solicitud sin action");
      
    }
    
    switch ($HTTPaction) {

      case 'verify_code':
        if (isset($_POST['usuario'])) {
          $usuario = json_decode($_POST['usuario']);
          $rawdata = $ajaxController->verify_code($usuario);
        }else{
          http_response_code(400);
          $rawdata = array('status' => 'error', 'message' => 'No se ha indicado parámetros.');
        }
        echo json_encode($rawdata);

      break;

      case 'searchPremios':
        if (isset($_POST['usuario'])) {
          $usuario = json_decode($_POST['usuario']);
          $respuesta = $ajaxController->searchPremios($usuario);
          $rawdata = array('status' => 'OK', 'message' => 'Busqueda finalizada', 'data' => $respuesta);
        }else{
          http_response_code(400);
          $rawdata = array('status' => 'error', 'message' => 'No se ha indicado parámetros.');
        }
        echo json_encode($rawdata);

      break;

      default:
          $rawdata = array('status' => 'error', 'message' =>'El API no ha podido responder la solicitud, revise el tipo de action');
          echo json_encode($rawdata);
      break;
    }
    
  } catch (Exception $ex) {
    //Return error message
    $rawdata = array();
    $rawdata['status'] = "error";
    $rawdata['message'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


