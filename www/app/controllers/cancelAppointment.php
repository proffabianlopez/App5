<?php
require_once '../models/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexion = conectar();
    $id = $_POST['id']; // El parámetro ahora es 'id', como lo enviamos desde JavaScript
    
    if ($conexion) {
        try {
            // Iniciar la transacción
            $conexion->beginTransaction();

            // Validar que el ID no esté vacío
            if (!empty($id)) {
                // Actualizar la tabla `appointment`
                $query1 = "UPDATE appointment SET status = 0 WHERE id = :id";

                $stmt1 = $conexion->prepare($query1);

                // Aquí debes usar $stmt1 para bindear el parámetro
                $stmt1->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt1->execute();
                // Confirmar la transacción
                $conexion->commit();

                echo "Turno canelado.";
            } else {
                echo "ID no válido. Comuniquese con administración.";
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
