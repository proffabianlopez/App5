<?php
require_once '../models/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectar();
    $doctorId = $_POST['id'];
    
    if ($conexion) {
        try {
            // Iniciar la transacción
            $conexion->beginTransaction();

            // Validar que el ID no esté vacío
            if (!empty($doctorId)) {
                // Actualizar la tabla `specialist`
                $query = "UPDATE specialist SET status = 0 WHERE id = ?";
                $stmt = $conexion->prepare($query);
                $stmt->execute([$doctorId]);
                // Confirmar la transacción
                $conexion->commit();

                echo "Eliminación exitosa del doctor.";
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
