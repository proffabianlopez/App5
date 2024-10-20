<?php
session_start();
if (isset($_SESSION)) {
    if ($_SESSION['rol'] == "" || $_SESSION['rol'] != '1') {
        // var_dump($_SESSION['rol']);
        // exit;
        // ob_start();
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorId = $_POST['id_specialist'];
    $speciality = $_POST['id_speciality'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    //$dia_servicio = $_POST['dia_servicio'];
}

echo $doctorId." - ".$speciality." - ".$date." - ".$time;

?>