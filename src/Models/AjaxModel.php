<?php namespace App\Models;

class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    // Actualizar tabla de ganadores con codigo canjeado
    public function save_ganador(object $usuario, String $premioID) {
        $nombreUpper = strtoupper($usuario->nombre);
        $fechaActual = date('Y-m-d H:i:s');

        try{
            $this->instancia->beginTransaction();  

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
                $stmt->bindParam(':premio_id', $premioID); 
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
                $stmt->bindParam(':premio_id', $premioID); 
                $stmt->execute();
                $resulset_premio_asignado = $stmt->fetch( \PDO::FETCH_ASSOC );

           
           

            $commit = $this->instancia->commit();
            return array('status' => 'success', 
                        'message' => $message, 
                        'commit'=>$commit
                    );
            
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

    // Retorna un premio random
    public function getPremioRandom(String $dia, Int $numeroAleatorio) {
        $query = " 
            SELECT 
                id, 
                premio, 
                $dia AS winrate
            FROM 
                aleatorio 
            WHERE $dia >= :aleatorio AND $dia != 0 
            LIMIT 1
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
            $stmt->bindValue(':aleatorio', $numeroAleatorio); 
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

    // Retorna un row si el codigo esta disponible
    public function getCodigoDisponible(String $codigoPromo) {
        $query = " 
            SELECT 
                nombre, 
                codigo, 
                dni 
            FROM ganadores 
            WHERE codigo = :codigoPromo AND dni = '' AND nombre = ''
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
            $stmt->bindParam(':codigoPromo', $codigoPromo); 
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

    public function getConteoPremiosEntregados() {
        $query = " 
        SELECT 
            premios.id,
            premios.nombre_premio,
            COUNT(premio_id) as cant_premios_entregados
        FROM ganadores
        RIGHT JOIN premios ON premios.id = ganadores.premio_id
        GROUP BY 
            premios.id,
            premios.nombre_premio,
            premio_id
        ORDER BY 
            premios.id
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
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

    public function searchPremios(object $usuario) {
        $query = " 
            SELECT * FROM ganadores
            INNER JOIN premios ON ganadores.premio_id = premios.id
            WHERE dni = :dni AND telefono = :telefono ORDER BY fecha ASC
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



   
    
