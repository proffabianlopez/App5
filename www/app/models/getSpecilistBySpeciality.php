<?php
require_once 'connection.php';
function obtenerEspecialistaPorEspecialidad($speciality) {
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM specialist_license_specialty WHERE id_speciality = :speciality";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Enlazar el parámetro de manera segura
        $stmt->bindParam(':speciality', $speciality, PDO::PARAM_INT);
        
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
