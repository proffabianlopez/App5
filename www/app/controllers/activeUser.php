<?php
require_once '../models/connection.php'

// variables con el o los datos necesarios para la actualizacion del estado del usario
$person_id=$_POST["id_person"]; //lo obtengo desde el js.

// Conectamos a la base de datos
$conexion = conectar();
    
if ($conexion) {
    try {
        // Iniciamos la transacción
        $conexion->beginTransaction();
         
        // Preparamos la consulta SQL
        $query = "UPDATE user 
                SET status = 1
                WHERE id_person = :person_id";
         
        $stmt = $conexion->prepare($query);
         
        // Asignamos los valores a los parámetros
        $stmt->bindParam(':person_id', $person_id, PDO::PARAM_INT);
         
        // Ejecutamos la consulta
        if ($stmt->execute()) {
            // Si la consulta fue exitosa, confirmamos la transacción
            $conexion->commit();
            echo "El estado del usuario ha sido actualizado correctamente.";
        } else {
            // Si algo falla, revertimos la transacción
            $conexion->rollBack();
            echo "Error al actualizar el estado del usuario.";
        }
    } catch (PDOException $e) {
        // En caso de error, se revierte la transacción y mostramos el error
        $conexion->rollBack();
        echo "Error en la consulta: " . $e->getMessage();
    }

    // Cerramos la conexión
    cerrarConexion($conexion);
} else {
    echo "No se pudo establecer la conexión a la base de datos.";
}