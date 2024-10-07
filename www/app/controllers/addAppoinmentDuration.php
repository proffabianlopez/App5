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
    $duracion = $_POST['duracion'];
}
$conexion = conectar();
if($conexion){
    try{
        $conexion->beginTransaction();
        $query = "INSERT INTO appointment_duration (appointment_duration) VALUES (:duracion)";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':duracion', $duracion, PDO::PARAM_INT);
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