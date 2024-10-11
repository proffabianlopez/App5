<?php
session_start();
// error_reporting(0);
include '../models/connection.php';
include 'login.php';
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