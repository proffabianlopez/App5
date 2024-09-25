<?php
require_once '../models/connection.php';
require_once 'login.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$onlineConsultation = $_POST['onlineConsultation'];
$street = $_POST['street'];
$number = $_POST['number'];
$apartment = $_POST['apartment'];
$floor = $_POST['floor'];

//echo $name, " ", $surname, " ", $onlineConsultation, " ", $street, " ", $apartment, " ", $floor;


// Conectamos a la base de datos
$conexion = conectar();
    
if ($conexion) {
    try {
        // Iniciamos la transacción
        $conexion->beginTransaction();
         
        // Preparamos la consulta SQL
        $query = "INSERT INTO specialist (name, surname, online_consultation, street, number, apartment, floor) VALUES (:name, :surname, :online_consultation, :street, :number, :apartment, :floor)";
         
        $stmt = $conexion->prepare($query);
         
        // Vincular los parámetros a las variables de PHP
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':online_consultation', $onlineConsultation, PDO::PARAM_INT);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':number', $number, PDO::PARAM_INT);
        $stmt->bindParam(':apartment', $apartment, PDO::PARAM_STR);
        $stmt->bindParam(':floor', $floor, PDO::PARAM_STR);
         
        // Ejecutamos la consulta
        if ($stmt->execute()) {
            // Si la consulta fue exitosa, confirmamos la transacción
            $conexion->commit();
            //echo "Datos insertasdos correctamente.";
            header('Location:../views/admin/dashboard.php');
            exit();
        } else {
            // Si algo falla, revertimos la transacción
            $conexion->rollBack();
            echo "Error al insertar datos.";
        }
    } catch (PDOException $e) {
        // En caso de error, se revierte la transacción y mostramos el error
        $conexion->rollBack();
        echo "Error en la consulta: " . $e->getMessage();
    }

    // Cerramos la conexión
    cerrarConexion($conexion);
} else {
    echo "No se pudo establecer la conexión a la base de datos.";
}