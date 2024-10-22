<?php
session_start();
require_once '../models/connection.php';
//require_once 'login.php';
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

include '../models/getUserContactById.php';
include '../models/getUserAddressById.php';
include '../models/updateContactUser.php';
include '../models/updateAddressUser.php';
include '../models/insertUserAddress.php';
include '../models/insertUserContact.php';

//var_dump($_SESSION);
$street = $_POST['street'];
$number = $_POST['number'];
$apartment = $_POST['apartment'];
$floor = $_POST['floor'];
$id_neighborhood = $_POST['id_neighborhood'];
$contact = $_POST['contact'];
$id_contact_type = $_POST['id_contact_type'];

$id_person = $_SESSION['person'];
$id_address_type = $_POST['id_address_type'];

//echo $name, " ", $surname, " ", $onlineConsultation, " ", $street, " ", $apartment, " ", $floor;

$userContact = obtenerContactoPorId($_SESSION['person']);
//var_dump($userContact);
$userAddress = obtenerDomicilioPorId($_SESSION['person']);
//var_dump($userAddress);

// Conectamos a la base de datos
$conexion = conectar();
    
if ($conexion) {
    try {
        if(!empty($userContact)){
            updateContact($contact, $id_contact_type, $id_person);
        } else{
            insertContact($contact, $id_contact_type, $id_person);
        }
        if(!empty($userAddress)){
            updateAddress($street, $number, $apartment, $floor, $id_neighborhood, $id_person);
        } else{
            insertAddress($street, $number, $apartment, $floor, $id_neighborhood, $id_person, $id_address_type);;
        }

    } catch(PDOException $e){
        echo "Error en la consulta: " . $e->getMessage();
    }

    // Cerramos la conexión
    cerrarConexion($conexion);
} else {
    echo "No se pudo establecer la conexión a la base de datos.";
}

/* 
No hay una transaccion iniciada para poder usar rollback en este caso
catch (PDOException $e) {
        // En caso de error, deshacemos la transacción y mostramos el error
        $conexion->rollBack();
        echo "Error en la consulta: " . $e->getMessage();
    }
*/

