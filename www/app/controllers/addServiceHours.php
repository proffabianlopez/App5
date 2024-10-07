<?php
error_reporting(0);
include '../models/connection.php';
include 'login.php';

if(!isset($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../views/login.php";';
    echo '</script>';
    exit();
}
else{
    session_start();
}
//var_dump($_SESSION);
if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../views/login.php";';
    echo '</script>';
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
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
?>