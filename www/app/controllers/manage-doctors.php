<?php
$id_doctor = $_POST['id_doctor'];
$duracion_del_turno = $_POST['duracion_del_turno'];
$id_dia = $_POST['id_dia'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

echo $id_doctor, " ", $duracion_del_turno, " ", $desde, " ", $hasta, " ";
foreach($id_dia as $dia){
    echo $dia;
}
