<?php
$id_doctor = $_POST['id_doctor'];
$duracion_del_turno = $_POST['duracion_del_turno'];

if (isset($_POST['dia'])) {
    $id_dia = $_POST['dia'];

    // Mapeo de id a día de la semana
    $dias_semana = [
        1 => "Lunes",
        2 => "Martes",
        3 => "Miércoles",
        4 => "Jueves",
        5 => "Viernes",
        6 => "Sábado",
        7 => "Domingo"
    ];

    $dia_seleccionado = $dias_semana[$id_dia];

    echo "Has seleccionado el día: $dia_seleccionado con ID: $id_dia";
}

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

echo $id_doctor, " ", $duracion_del_turno, " ", $desde, " ", $hasta, " ";
/*foreach($id_dia as $dia){
    echo $dia;
}*/
