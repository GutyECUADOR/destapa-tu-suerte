<?php namespace App\Models;

class LoginModel extends Conexion {
 
    public function __construct() {
        parent::__construct();
    }

    public function validaIngreso($arrayDatos){

        $cedula = $arrayDatos['cedula'];
        $telefono = $arrayDatos['telefono'];

        $query = "
            SELECT * FROM `usuarios` 
            WHERE 
                cedula = :cedula AND
                telefono = :telefono
            LIMIT 1
        ";
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':cedula', $cedula); 
        $stmt->bindParam(':telefono', $telefono); 
    
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }

        return $resulset; 
    }

    public function getUserByEmail ($email) {
        $query = "
            SELECT * FROM `usuarios` WHERE email = :email
        ";
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':email', $email); 
       
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }

        return $resulset;
    }

    /* Retorna el nombre array con la clave NameDatabase y Codigo para el nombre de la instancia, para ser usada en la conexion*/ 
    public function getCodeinstanciaByName($nombreinstancia){
        $query = "SELECT TOP 1 NameDatabase, Codigo FROM SBIOKAO.instanciao.Empresas_WF WHERE NameDatabase = :NameDatabase"; 
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindParam(':NameDatabase', $nombreinstancia); 
    
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    /* Retorna el nombre array con la clave Codigo, Nombre para el nombre de la instancia, para ser usada en la conexion*/ 
    public function getAllDataBaseList(){
        $query = "SELECT * FROM SBIOKAO.dbo.Empresas_WF"; 
        $stmt = $this->instancia->prepare($query); 
     
            if($stmt->execute()){
                $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }
    
    
}
