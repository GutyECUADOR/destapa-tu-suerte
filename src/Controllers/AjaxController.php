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
        $numeroAleatorio = rand(1, 100);

        // Obtenemos premio random segun el dia
        $premioRandom = $this->ajaxModel->getPremioRandom($diaActual, $numeroAleatorio);
        if ($premioRandom) {
            // Verificamos si codigo ingresado esta disponible
            $isCodigoDisponible = $this->ajaxModel->getCodigoDisponible($usuario->codigo);
            if ($isCodigoDisponible) {
                // Actualizar tabla de ganadores con codigo canjeado
               $response = $isCodigoDisponible;
            }else{
                $response = array('status' => 'error', 'message' => "El código promocional: $usuario->codigo no es válido. En el momento de registrar tu código ganador, asegúrate de hacerlo de forma correcta teniendo en cuenta los ceros las letras o las letras i y l.", 'response'=> $isCodigoDisponible);
            }
        }else{
            $response = array('status' => 'error', 'message' => 'No se pudo obtener un premio aleatorio.', 'response'=> $premioRandom);
        }


        return $response; //$this->ajaxModel->verify_code($usuario);
    }

    public function searchPremios(object $usuario){
        return $this->ajaxModel->searchPremios($usuario);
    }

    public function getConteoPremiosEntregados(){
        return $this->ajaxModel->getConteoPremiosEntregados();
    }

    

}
