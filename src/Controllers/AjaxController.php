<?php namespace App\Controllers;

use App\Models\AjaxModel;

class AjaxController  {

    public $defaulDataBase;
    public $ajaxModel;
   
    public function __construct() {
        $this->defaulDataBase = (!isset($_SESSION["empresaAUTH".APP_UNIQUE_KEY])) ? $_ENV['DB_NAME'] : $_SESSION["empresaAUTH".APP_UNIQUE_KEY];
        $this->ajaxModel = new AjaxModel();
        $this->ajaxModel->setDbname($this->defaulDataBase);
        $this->ajaxModel->conectarDB();
    }

    public function verify_code(object $usuario){
        $dias = array('domingo','lunes', 'martes', 'miercoles', 'jueves','viernes','sabado');
        $diaActual = $dias[date("w")];
        $aleatorio = rand(0, 100);

        return  $this->ajaxModel->verify_code($usuario, $diaActual, $aleatorio);
    
    }

    public function searchPremios(object $usuario){
        return $this->ajaxModel->searchPremios($usuario);
       
    }

    

}
