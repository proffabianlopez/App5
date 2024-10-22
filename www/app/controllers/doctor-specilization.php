<?php
session_start();
require_once '../models/connection.php';

// Validar sesión
if (isset($_SESSION)) {
    if ($_SESSION['rol'] == "" || $_SESSION['rol'] != '2') {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../login.php";';
        echo '</script>';
        exit();
    }
} else {
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

// Validar que se haya enviado una especialidad
if (empty($especialidad = $_POST['especialidad'])) {
    echo '<script type="text/javascript">';
    echo 'alert("Ingrese una especialidad");';
    echo 'window.location.href="../views/admin/doctor-specilization.php";';
    echo '</script>';
    exit();
}

// Conectar a la base de datos
$connection = conectar();

if ($connection) {
    try {
        // Verificar si la especialidad ya existe
        $query = "SELECT COUNT(*) FROM specialisties WHERE speciality = :speciality";
        $stmt = $connection->prepare($query);
        $stmt->execute([':speciality' => $especialidad]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            // La especialidad ya existe, mostrar mensaje de error
            echo '<script type="text/javascript">';
            echo 'alert("La especialidad ya está registrada, ingrese una nueva.");';
            echo 'window.location.href="../views/admin/doctor-specilization.php";';
            echo '</script>';
        } else {
            // Iniciar la transacción
            $connection->beginTransaction();

            // Insertar la nueva especialidad
            $query = "INSERT INTO specialisties (speciality) VALUES (:speciality)";
            $stmt = $connection->prepare($query);
            $stmt->execute([':speciality' => $especialidad]);

            // Confirmar la transacción
            $connection->commit();

            // Redirigir con mensaje de éxito
            echo '<script type="text/javascript">';
            echo 'window.location.href="../views/admin/doctor-specilization.php?status=success";';
            echo '</script>';
        }

        // Cerrar la conexión
        cerrarConexion($connection);
        exit();

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $connection->rollBack();
        echo "Error al insertar datos: " . $e->getMessage();
    }
}
?>
