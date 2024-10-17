<?php
session_start();
if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '2') {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../views/login.php";';
        echo '</script>';
        exit();
    } 
} else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../views/login.php";';
        echo '</script>';
        exit();
}

require_once '../models/updateSpecialist.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $doctorId = $_POST['id_doctor'];
    $doctorNombre = !empty($_POST['name']) ? $_POST['name'] : $_POST['doctorName'];
    $doctorApellido = !empty($_POST['surname']) ? $_POST['surname'] : $_POST['doctorSurname'];
    $doctorOnlineConsultation = $_POST['onlineConsultation'];
    $doctorCalle = !empty($_POST['street']) ? $_POST['street'] : $_POST['doctorStreet'];
    $doctorNumero = !empty($_POST['number']) ? $_POST['number'] : $_POST['doctorNumber'];
    $doctorDepartamento = !empty($_POST['apartment']) ? $_POST['apartment'] : $_POST['doctorApartment'];
    $doctorPiso = !empty($_POST['floor']) ? $_POST['floor'] : $_POST['doctorFloor'];

    // Llamamos a la función con los parámetros en el orden correcto
    UpdateSpecialist($doctorId, $doctorNombre, $doctorApellido, $doctorOnlineConsultation, $doctorCalle, $doctorNumero, $doctorDepartamento, $doctorPiso);
} else {
    echo "Método de envio invalido, no se han recibido los datos";
}
?>
