<?php namespace App\Models;

class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function verify_code(object $usuario) {
        $nombreUpper = strtoupper($usuario->nombre);
        $fechaActual = date('Y-m-d H:i:s');

        try{
            $this->instancia->beginTransaction();  
            $query = "SELECT * FROM usuarios WHERE codigo = :codigo_select AND dni = '' AND (nombre = '' OR dni =:dni_select)";  

            $stmt = $this->instancia->prepare($query); 
            $stmt->bindParam(':codigo_select', $usuario->codigo); 
            $stmt->bindParam(':dni_select', $usuario->cedula); 
            $stmt->execute();
            $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );

            if ($resulset) {
                $query = " 
                    UPDATE usuarios 
                    SET nombre = :nombre,
                        dni = :dni,
                        correo = :correo,
                        telefono = :telefono,
                        fecha = :fecha
                    WHERE codigo = :codigo
                    "
                ;  
                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':nombre', $nombreUpper); 
                $stmt->bindParam(':dni', $usuario->cedula); 
                $stmt->bindParam(':correo', $usuario->correo); 
                $stmt->bindParam(':telefono', $usuario->telefono); 
                $stmt->bindParam(':fecha', $fechaActual); 
                $stmt->bindParam(':codigo', $usuario->codigo); 
                $stmt->execute();
                $message ="Felicidades Ganaste!!!";
            }else{
                $message ="El codigo de registro no es válido o ya fue utilizado.";
            }

           

            $commit = $this->instancia->commit();
            return array('status' => 'success', 'message' => $message, 'commit'=>$commit ,'usuario'=> $resulset);
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            switch ($exception->getCode ()) {
                case '23000':
                    return array('status' => 'error', 'message' => 'El número de documento de identidad ya está registrado. ', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
                
                default:
                    return array('status' => 'error', 'message' => 'No se pudo registrar en la base de datos, reintente.', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
            }
            
        }
   
    }

    
}



   
    
