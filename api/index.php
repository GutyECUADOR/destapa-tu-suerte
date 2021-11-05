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

      case 'procesar_premio':
        if (isset($_POST['usuario'])) {
          $usuario = json_decode($_POST['usuario']);
          $rawdata = $ajaxController->procesar_premio($usuario);
        }else{
          http_response_code(400);
          $rawdata = array('status' => 'error', 'message' => 'No se ha indicado parámetros.');
        }
        echo json_encode($rawdata);

      break;

      case 'updateRecargaData':
        if (isset($_POST['recargadata'])) {
          $recargadata = json_decode($_POST['recargadata']);
          $rawdata =  $ajaxController->updateRecargaData($recargadata); 
        }else{ 
          http_response_code(400);
          $rawdata = array('status' => 'error', 'message' => 'No se ha indicado parámetros de registro.');
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

      case 'getConteoPremiosEntregados':
          $respuesta = $ajaxController->getConteoPremiosEntregados();
          $rawdata = array('status' => 'OK', 'message' => 'Busqueda finalizada', 'premios' => $respuesta);
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


