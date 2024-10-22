<?php
require_once 'connection.php';

function obtenerUsuariosYPersonas() {
    $conecction = conectar();
    if ($conecction) {
        $query = "SELECT 
            u.id AS user_id,   
            p.name,            
            p.surname,        
            p.dni,             
            p.birth_date,  
            p.status AS person_status,  
            u.email          
        FROM 
            user u
        JOIN 
            person p ON u.id_person = p.id  
        WHERE 
            p.status = 1   
            AND
            u.id_rol = 1";
        
        $stmt = $conecction->prepare($query);
        
        $stmt->execute();
        
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        cerrarConexion($conecction);
        
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}