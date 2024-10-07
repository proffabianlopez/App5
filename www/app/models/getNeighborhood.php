<?php
require_once 'connection.php';

function obtenerBarrio($neighborhood){
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT name FROM neighborhood WHERE id = :barrio";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Asignar valores a los parámetros
        $stmt->bindParam(':barrio', $neighborhood);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Cerrar la conexión
        cerrarConexion($conecction);
        
        // Retornar los resultados
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}
