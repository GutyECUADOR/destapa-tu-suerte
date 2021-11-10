<?php namespace App\Controllers;

use App\Models\AjaxModel;

class AjaxController  {

    public $defaulDataBase;
    public $ajaxModel;
    public $dias = array('domingo','lunes', 'martes', 'miercoles', 'jueves','viernes','sabado');
   
    public function __construct() {
        $this->defaulDataBase = (!isset($_SESSION["empresaAUTH".APP_UNIQUE_KEY])) ? $_ENV['DB_NAME'] : $_SESSION["empresaAUTH".APP_UNIQUE_KEY];
        $this->ajaxModel = new AjaxModel();
        $this->ajaxModel->setDbname($this->defaulDataBase);
        $this->ajaxModel->conectarDB();
    }

    public function procesar_premio(object $usuario){
        $diaActual = $this->dias[date("w")];
        $intentos = 0;
        // Obtenemos premio random segun el dia
        do {
            $numeroAleatorio = rand(1, 100);
            $premioRandom = $this->ajaxModel->getPremioRandom($diaActual, $numeroAleatorio);
            $intentos++;
            if ($intentos >= 10) {
                return $response = array('status' => 'error', 'message' => "Gracias por participar, tu tapa no ha sido premiada, sigue intentándolo hay espectaculares premios que puedes ganar.");
            }
        } while ($premioRandom['disponibles'] <= $premioRandom['entregados']); // Repetir mientras los entregados sean mayores o iguales a los disponibles
        
        if ($premioRandom) {
            // Verificamos si codigo ingresado esta disponible
            $isCodigoDisponible = $this->ajaxModel->getCodigoDisponible($usuario->codigo);
            if ($isCodigoDisponible && strlen($isCodigoDisponible['nombre']) == 0 && strlen($isCodigoDisponible['dni']) == 0) {
                // Actualizar tabla de ganadores con codigo canjeado
               $response = $this->ajaxModel->save_ganador($usuario, $premioRandom['id']);
            }elseif ($isCodigoDisponible && (strlen($isCodigoDisponible['nombre']) > 0 || strlen($isCodigoDisponible['dni']) > 0)){
                $response = array('status' => 'error', 'message' => "El código promocional: $usuario->codigo ya ha sido utilizado.", 'response'=> $isCodigoDisponible);
            }else{
                $response = array('status' => 'error', 'message' => "El código promocional: $usuario->codigo no es válido. En el momento de registrar tu código ganador, asegúrate de hacerlo de forma correcta teniendo en cuenta los ceros las letras o las letras i y l.", 'response'=> $isCodigoDisponible);
            }
        }else{
            $response = array('status' => 'error', 'message' => 'No se pudo obtener un premio aleatorio. Reintente más tarde. Si el problema persiste comunícate al centro de atención. ', 'response'=> $premioRandom);
        }


        return $response; 
    }

    public function searchPremios(object $usuario){
        return $this->ajaxModel->searchPremios($usuario);
    }

    public function getConteoPremiosEntregados(){
        return $this->ajaxModel->getConteoPremiosEntregados();
    }

    public function updateRecargaData(object $recargaData){
        return $this->ajaxModel->updateRecargaData($recargaData);
    }

    public function getBetPlayCode(object $dni){
        return $this->ajaxModel->getBetPlayCode($dni);
    }

    

}
