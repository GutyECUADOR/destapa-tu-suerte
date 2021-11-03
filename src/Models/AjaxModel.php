<?php namespace App\Models;

class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function verify_code(object $usuario, string $diaActual, int $aleatorio) {
        $nombreUpper = strtoupper($usuario->nombre);
        $fechaActual = date('Y-m-d H:i:s');

        try{
            $this->instancia->beginTransaction();  

            // Obteniendo el premio aleatorio
            $query = "SELECT id, premio, :diaActual FROM aleatorio WHERE :diaActual_1 >= :aleatorio LIMIT 1";  

            $stmt = $this->instancia->prepare($query); 
            $stmt->bindParam(':diaActual', $diaActual); 
            $stmt->bindParam(':diaActual_1', $diaActual);
            $stmt->bindParam(':aleatorio', $aleatorio); 
            $stmt->execute();
            $resulset_premio = $stmt->fetch( \PDO::FETCH_ASSOC );

            // Consultar si codigo esta disponible
            $query = "SELECT nombre, codigo, dni FROM ganadores WHERE codigo = :codigo_select AND dni = '' AND nombre = ''";  

            $stmt = $this->instancia->prepare($query); 
            $stmt->bindParam(':codigo_select', $usuario->codigo); 
            $stmt->execute();
            $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );

            if ($resulset) {
                // Actualizar tabla de ganadores con codigo canjeado
                $query = " 
                    UPDATE ganadores 
                    SET nombre = :nombre,
                        dni = :dni,
                        correo = :correo,
                        telefono = :telefono,
                        fecha = :fecha,
                        premio_id = :premio_id
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
                $stmt->bindParam(':premio_id', $resulset_premio['id']); 
                $stmt->execute();
                $message ="Felicidades Ganaste!!!";


                // Obteniendo el premio 
                $query = "
                    SELECT * 
                    FROM premios 
                    INNER JOIN ganadores ON ganadores.premio_id = premios.id
                    WHERE premios.id = :premio_id
                ";  

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':premio_id', $resulset_premio['id']); 
                $stmt->execute();
                $resulset_premio = $stmt->fetch( \PDO::FETCH_ASSOC );

            }else{
                $message ="El código de registro no es válido o ya fue utilizado.";
            }

           

            $commit = $this->instancia->commit();
            return array('status' => 'success', 'message' => $message, 'commit'=>$commit ,'consulta_codigo'=> $resulset, 'premio' => $resulset_premio);
            
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

    public function searchPremios(object $usuario) {
        $query = " 
            SELECT * FROM usuarios WHERE dni = :dni AND telefono = :telefono ORDER BY fecha ASC
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
            $stmt->bindValue(':dni', $usuario->cedula);
            $stmt->bindValue(':telefono', $usuario->telefono);

                if($stmt->execute()){
                    $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
                    
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(\PDOException $exception){
            return array('status' => 'ERROR', 'message' => $exception->getMessage() );
        }
   
    }

    
}



   
    
