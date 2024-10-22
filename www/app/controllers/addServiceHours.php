<?php
session_start();
error_reporting(0);
include '../models/connection.php';

if (isset($_SESSION)) {
    if ($_SESSION['rol'] == "" || $_SESSION['rol'] != '2') {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../login.php";';
        echo '</script>';
        exit();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $start_time = $_POST['desde'];
    $end_time = $_POST['hasta'];

    // Validar que la hora de inicio sea menor que la hora final
    if ($start_time === $end_time) {
        echo "La hora de inicio no puede ser igual a la hora final.";
        exit();
    }
}
$conexion = conectar();

if ($conexion) {
    // Verificar si ya existe un registro con los mismos valores de start_time y end_time
    $query = "SELECT COUNT(*) AS total FROM service_hours WHERE start_time = :start_time AND end_time = :end_time";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        // Si los valores ya existen
        echo "Este horario de servicio ya existe. Por favor, ingrese otro intervalo de tiempo.";
    } else {
        // Si no existe, insertar los valores nuevos
        try {
            $conexion->beginTransaction();
            $insertQuery = "INSERT INTO service_hours (start_time, end_time) VALUES (:start_time, :end_time)";
            $stmtInsert = $conexion->prepare($insertQuery);
            $stmtInsert->bindParam(':start_time', $start_time, PDO::PARAM_STR);
            $stmtInsert->bindParam(':end_time', $end_time, PDO::PARAM_STR);
            $stmtInsert->execute();

            // Confirmar la transacción
            $conexion->commit();
            echo "Horario de servicio agregado correctamente: hora de inicio " . $start_time . " hora de finalización " . $end_time;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            echo "Error al insertar el horario: " . $e->getMessage();
        }
    }

    // Cerrar la conexión
    cerrarConexion($conexion);
} else {
    echo "Error al conectar a la base de datos.";
}

?>
