<?php
session_start();
require_once '../models/connection.php';
require_once 'login.php';
if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '1') {
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

$street = $_POST['street'];
$number = $_POST['number'];
$apartment = $_POST['apartment'];
$floor = $_POST['floor'];
$id_neighborhood = $_POST['id_neighborhood'];
$contact = $_POST['contact'];
$id_contact_type = $_POST['id_contact_type'];
$id_person = $_POST['id_person'];
//echo $name, " ", $surname, " ", $onlineConsultation, " ", $street, " ", $apartment, " ", $floor;

// Conectamos a la base de datos
$conexion = conectar();
    
if ($conexion) {
    try {
        // Iniciamos la transacción
        $conexion->beginTransaction();
        
        // Preparamos la consulta SQL para actualizar en la tabla 'address'
        $queryAddress = "UPDATE address SET street = :street, number = :number, apartment = :apartment, floor = :floor, id_neighborhood = :id_neighborhood WHERE id_person = :id_person";

        $stmtAddress = $conexion->prepare($queryAddress);

        // Vincular los parámetros a las variables de PHP
        $stmtAddress->bindParam(':street', $street, PDO::PARAM_STR);
        $stmtAddress->bindParam(':number', $number, PDO::PARAM_INT);
        $stmtAddress->bindParam(':apartment', $apartment, PDO::PARAM_STR);
        $stmtAddress->bindParam(':floor', $floor, PDO::PARAM_STR);
        $stmtAddress->bindParam(':id_neighborhood', $id_neighborhood, PDO::PARAM_INT);
        $stmtAddress->bindParam(':id_person', $id_person, PDO::PARAM_INT);

        // Ejecutamos la consulta
        if ($stmtAddress->execute()) {
            // Si la actualización en 'address' fue exitosa, procedemos con 'contact'
            
            // Preparamos la consulta SQL para actualizar en la tabla 'contact'
$queryContact = "UPDATE contact SET contact = :contact, id_contact_type = :id_contact_type WHERE id_person = :id_person";

$stmtContact = $conexion->prepare($queryContact);

// Vincular los parámetros a las variables de PHP
$stmtContact->bindParam(':contact', $contact, PDO::PARAM_STR);
$stmtContact->bindParam(':id_contact_type', $id_contact_type, PDO::PARAM_INT);
$stmtContact->bindParam(':id_person', $id_person, PDO::PARAM_INT);

// Ejecutamos la consulta
if ($stmtContact->execute()) {
    // Si ambas consultas fueron exitosas, confirmamos la transacción
    $conexion->commit();
    echo "Datos actualizados correctamente.";
    // Redirigir si es necesario
    // header('Location:../views/admin/dashboard.php');
} else {
    // Si falla la actualización en 'contact', deshacemos la transacción
    $conexion->rollBack();
    echo "Error al actualizar los datos de contacto.";
}

        } else {
            // Si falla la actualización en 'address', deshacemos la transacción
            $conexion->rollBack();
            echo "Error al actualizar la dirección.";
        }

    } catch (PDOException $e) {
        // En caso de error, deshacemos la transacción y mostramos el error
        $conexion->rollBack();
        echo "Error en la consulta: " . $e->getMessage();
    }

    // Cerramos la conexión
    cerrarConexion($conexion);
} else {
    echo "No se pudo establecer la conexión a la base de datos.";
}
