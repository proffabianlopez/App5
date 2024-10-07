<?php
require_once '../models/connection.php';
require_once '../models/getSpecialistById.php';

//aqui ya puedo modificar cada doctor, los valores que yo desee.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorId = $_GET['id'];
    $doctors = obtenerEspecialistaPorId($doctorId);
    // ejemplo de como obtener cada campo del doctor con su id
    // usar mas funciones en caso de querer actualizar más cosas
    foreach($doctors as $doctor){
        echo $doctor['name'];
    }
}
?>