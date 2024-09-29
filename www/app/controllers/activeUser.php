<?php
require_once '../models/connection.php'; // Falta el punto y coma

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectamos a la base de datos
    $conexion = conectar();
    // Obtener el ID enviado desde la solicitud POST
    $userId = $_POST['id'];
    
    if ($conexion) {
        try {
            // Iniciar la transacción
            $conexion->beginTransaction();

            // Validar que el ID no esté vacío
            if (!empty($userId)) {
                // Actualizar la tabla `user`
                $query1 = "UPDATE user SET status = 1 WHERE id_person = ?";
                $stmt1 = $conexion->prepare($query1);
                $stmt1->execute([$userId]); 

                // Actualizar la tabla `person`
                $query2 = "UPDATE person SET status = 1 WHERE id = ?";
                $stmt2 = $conexion->prepare($query2);
                $stmt2->execute([$userId]);
                // Confirmar la transacción
                $conexion->commit();

                echo "Actualización exitosa en ambas tablas.";
            } else {
                echo "ID de usuario no válido.";
            }
        } catch (PDOException $e) {
            // En caso de error, revertir la transacción y mostrar el error
            $conexion->rollBack();
            echo "Error en la consulta: " . $e->getMessage();
        }

        // Cerrar la conexión
        cerrarConexion($conexion);
    } else {
        echo "No se pudo establecer la conexión a la base de datos.";
    }
}
?>
