<?php
session_start();
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

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];

    // Validar que la hora de inicio sea menor que la hora final
    if ($desde === $hasta) {
        echo "La hora de inicio no puede ser igual a la hora final.";
        exit();
    }

    $desdeTime = strtotime($desde);
    $hastaTime = strtotime($hasta);

    // Verificar que la hora de inicio sea menor que la final
    if ($desdeTime >= $hastaTime) {
        echo "La hora de inicio debe ser menor que la hora de fin.";
        exit();
    }

    // Verificar que la diferencia de tiempo no supere las 8 horas
    $diffHoras = ($hastaTime - $desdeTime) / 3600; // Diferencia en horas
    if ($diffHoras > 8) {
        echo "La franja horaria no puede ser mayor a 8 horas.";
        exit();
    }

    $desde = $desde . ":00";
    $hasta = $hasta . ":00";
    $conexion = conectar();
    if($conexion){
        try{
            $conexion->beginTransaction();
            $query = "INSERT INTO service_hours (start_time, end_time) VALUES (:desde, :hasta)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':desde', $desde, PDO::PARAM_STR);
            $stmt->bindParam(':hasta', $hasta, PDO::PARAM_STR);
            $stmt -> execute();
            // Confirmar (commit) la transacción
            $conexion->commit();
            echo "Datos insertados correctamente";
            cerrarConexion($conexion);
        }
        catch(Exception $e) {
            $conexion->rollBack();
            echo "Error al insertar datos: " . $e->getMessage();
        }
    }
}
?>