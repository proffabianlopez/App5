<?php
require_once 'connection.php'; // Incluye la conexión a la base de datos

// Función para obtener los turnos del día basado en la fecha
function obtenerTurnosDelDia($date) {
    $conecction = conectar(); // Establece la conexión
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT COUNT(*) AS total_appointments FROM appointment WHERE date = :date;";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Pasar el valor de la fecha como parámetro seguro
        $stmt->bindParam(':date', $date);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $stmt->fetchColumn();
        
        // Cerrar la conexión
        cerrarConexion($conecction); // Supone que tienes una función para cerrar la conexión
        
        // Retornar los resultados
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}
?>
