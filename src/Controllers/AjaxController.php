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
            if ($intentos >= 4) {
                return $response = array('status' => 'error', 'message' => "No existen más premios disponibles para este dia: $diaActual, intentalo el día de mañana");
            }
        } while ($premioRandom['disponibles'] <= $premioRandom['entregados']); // Repetir mientras los entregados sean mayores o iguales a los disponibles
        

        if ($premioRandom) {
            // Verificamos si codigo ingresado esta disponible
            $isCodigoDisponible = $this->ajaxModel->getCodigoDisponible($usuario->codigo);
            if ($isCodigoDisponible) {
                // Actualizar tabla de ganadores con codigo canjeado
               $response = $this->ajaxModel->save_ganador($usuario, $premioRandom['id']);
               
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

    

}
