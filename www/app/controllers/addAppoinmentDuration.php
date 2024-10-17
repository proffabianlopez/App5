<?php
session_start();
error_reporting(0);
include '../models/connection.php';
//include 'login.php';
if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '2') {
        // var_dump($_SESSION['rol']);
        // exit;
        // ob_start();
        
            echo '<script type="text/javascript">';
            echo 'window.location.href="../login.php";';
            echo '</script>';
            exit();
    } 
    // else {
    //     $useremail = $_SESSION["email"];
    // }
} else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../login.php";';
        echo '</script>';
        exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $duracion = isset($_POST['duracion']) ? intval($_POST['duracion']) : null;
}

$conexion = conectar();

if($conexion) {
    // Verificar si la duración ya existe en la base de datos
    $query = "SELECT COUNT(*) AS total FROM appointment_duration WHERE 	appointment_duration = :duracion";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':duracion', $duracion, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        // Si la duración ya existe
        echo "La duración del turno ya existe. Por favor, ingrese una duración diferente.";
    } else {
        // Si no existe, insertar la nueva duración
        try {
            $conexion->beginTransaction();
            $insertQuery = "INSERT INTO appointment_duration (appointment_duration) VALUES (:duracion)";
            $stmtInsert = $conexion->prepare($insertQuery);
            $stmtInsert->bindParam(':duracion', $duracion, PDO::PARAM_INT);
            $stmtInsert->execute();
            
            // Confirmar la transacción
            $conexion->commit();
            echo "Duración de turno agregada correctamente: " . $duracion . " minutos";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            echo "Error al insertar datos: " . $e->getMessage();
        }
    }
    
    // Cerrar la conexión
    cerrarConexion($conexion);
} else {
    echo "Error al conectar a la base de datos.";
}

?>