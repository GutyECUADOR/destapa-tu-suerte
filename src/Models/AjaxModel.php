<?php namespace App\Models;

class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    // Retorna un premio random
    public function getPremioRandom(String $dia, Int $numeroAleatorio) {
        $query = "
            SELECT 
                aleatorio.id, 
                aleatorio.premio, 
                aleatorio.$dia AS winrate_range,
                cant_premios AS disponibles,
                (SELECT COUNT(premio_id) FROM ganadores WHERE premio_id= aleatorio.id ) AS entregados
            FROM 
                aleatorio 
            WHERE aleatorio.$dia >= :aleatorio AND aleatorio.$dia !=0 
            LIMIT 1
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
            $stmt->bindValue(':aleatorio', $numeroAleatorio); 
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
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
            WHERE codigo = :codigoPromo
        ";

        try{
            $stmt = $this->instancia->prepare($query); 
            $stmt->bindParam(':codigoPromo', $codigoPromo); 
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
            return $resulset;  

        }catch(\PDOException $exception){
            return array('status' => 'ERROR', 'message' => $exception->getMessage() );
        }
   
    }

    function replaceAccents($str)
    {
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return str_replace($a, $b, $str);
    }

    // Actualizar tabla de ganadores con codigo canjeado
    public function save_ganador(object $usuario, String $premioID) {
        $nombreUpper = strtoupper($this->replaceAccents($usuario->nombre));


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
             
                // Obteniendo el premio 
                $query = "
                    SELECT *
                    FROM ganadores 
                    INNER JOIN premios ON premios.id = ganadores.premio_id
                    WHERE codigo = :codigoPromo
                ";  

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':codigoPromo', $usuario->codigo); 
                $stmt->execute();
                $response_premio = $stmt->fetch( \PDO::FETCH_ASSOC );

            if ($this->instancia->commit()) {
                $response = array('status' => 'success','message' => 'Felicidades Ganaste!!!', 'premio'=> $response_premio);
            }else{
                $response = array('status' => 'ERROR','message' => 'No se pudo registrar tu premio, reintenta. Si el problema persiste comunícate al centro de atención.');
            }

            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            switch ($exception->getCode ()) {
                case '23000':
                    return array('status' => 'error', 'message' => 'No se pudo registrar tu codigo. ', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
                
                default:
                    return array('status' => 'error', 'message' => 'No se pudo registrar en la base de datos, reintente.', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
            }
            
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

    public function updateRecargaData(object $recargaData) {
        $operadoraUpper = strtoupper($recargaData->operadora);
      
        try{
            $this->instancia->beginTransaction();  

                $query = " 
                    UPDATE ganadores 
                    SET
                        telefono_recarga = :telefono_recarga,
                        operadora_recarga = :operadora_recarga
                    WHERE codigo = :codigoPromo
                    "
                ;  
                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':telefono_recarga', $recargaData->telefono); 
                $stmt->bindParam(':operadora_recarga', $operadoraUpper); 
                $stmt->bindParam(':codigoPromo', $recargaData->codigo); 
                $stmt->execute();
             
            if ($this->instancia->commit()) {
                $response = array('status' => 'success','message' => 'Datos de recarga registrados.');
            }else{
                $response = array('status' => 'ERROR','message' => 'No se pudo registrar los datos de tu recarga, Registra tus datos desde la MI PERFIL. Si el problema persiste comunícate al centro de atención.');
            }

            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            switch ($exception->getCode ()) {
                case '23000':
                    return array('status' => 'error', 'message' => 'No se pudo registrar tu codigo. ', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
                
                default:
                    return array('status' => 'error', 'message' => 'No se pudo registrar en la base de datos, reintente.', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
            }
            
        }
   
    }

    public function getBetPlayCode(object $dniObject) {
        try{
            $this->instancia->beginTransaction();  

                $query = "
                    SELECT * FROM ganadores WHERE dni = :dni LIMIT 1
                ";  

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':dni', $dniObject->dni); 
                $stmt->execute();
                $response_ganador = $stmt->fetch( \PDO::FETCH_ASSOC );

                $query = "
                    SELECT * FROM betplaycodes WHERE isCanjeado = '' OR isCanjeado IS NULL LIMIT 1
                ";  

                $stmt = $this->instancia->prepare($query); 
                $stmt->bindParam(':dni', $dniObject->dni); 
                $stmt->execute();
                $codigo_disponible = $stmt->fetch( \PDO::FETCH_ASSOC );

                if ($response_ganador && $codigo_disponible) {
                    $query = " 
                        UPDATE betplaycodes SET isCanjeado = :ganador WHERE codigo = :codigo
                    "
                    ;  
                    $stmt = $this->instancia->prepare($query); 
                    $stmt->bindParam(':ganador', $dniObject->dni); 
                    $stmt->bindParam(':codigo', $codigo_disponible['codigo']); 
                   
                    $stmt->execute();
                }

             
            if ($this->instancia->commit() && $codigo_disponible) {
                $response = array('status' => 'success','message' => 'Datos de Betplay registrados.', 'codigobetpay' => $codigo_disponible['codigo']);
            }else{
                $response = array('status' => 'ERROR','message' => 'No se pudo obtener un código de Betplay disponible. Si el problema persiste comunícate al centro de atención.');
            }

            return $response;
            
        }catch(\PDOException $exception){
            $this->instancia->rollBack();
            switch ($exception->getCode ()) {
                case '23000':
                    return array('status' => 'error', 'message' => 'No se pudo registrar tu codigo. ', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
                
                default:
                    return array('status' => 'error', 'message' => 'No se pudo registrar en la base de datos, reintente.', 'mensajeEx' => $exception->getMessage(), 'errorCode' => $exception->getCode () );
                    break;
            }
            
        }
   
    }

    
}



   
    
