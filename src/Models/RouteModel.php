<?php namespace App\Models;

class RouteModel {
    
    public function actionCatcherModel($action){
        switch ($action) {
            case 'inicio':
                $contenido = "views/modulos/canjePremioView.php";
                break;

            case 'mecanica':
                $contenido = "views/modulos/mecanicaView.php";
                break;

            case 'evento':
                $contenido = "views/modulos/eventoView.php";
                break;
            
            case 'premios':
                $contenido = "views/modulos/premiosView.php";
                break;

            default:
                $contenido = "views/modulos/canjePremioView.php";
                break;
        }
        
       
        return $contenido;
        
    }
}
