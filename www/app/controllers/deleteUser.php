<?php
require_once '../models/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectar();
    $userID = $_POST['id'];
    
    if ($conexion) {
        try {
            // Iniciar la transacción
            $conexion->beginTransaction();

            // Validar que el ID no esté vacío
            if (!empty($userID)) {
                // Actualizar la tabla `user`
                $query = "UPDATE user SET status = 0 WHERE id_person = ?";
                $stmt = $conexion->prepare($query);
                $stmt->execute([$userID]);

                // Actualizar la tabla `person`
                $query2 = "UPDATE person SET status = 0 WHERE id = ?";
                $stmt2 = $conexion->prepare($query2);
                $stmt2->execute([$userID]);

                // Confirmar la transacción
                $conexion->commit();

                echo "Eliminación exitosa del usario.";
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
