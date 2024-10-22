<?php
require_once 'connection.php';

function obtenerPersonaPorDni($dni){
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM person WHERE dni = :dni";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Asignar valores a los parámetros
        $stmt->bindParam(':dni', $dni);
        
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
?>