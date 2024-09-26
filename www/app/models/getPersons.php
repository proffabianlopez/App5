<?php
require_once 'connection.php';

function obtenerPersonas() {
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT p.* FROM person p JOIN user u ON p.id = u.id_person WHERE u.id_rol = 1";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Cerrar la conexión
        cerrarConexion($conecction);
        
        // Retornar los resultados
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}