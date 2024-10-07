<?php
include '../../controllers/login.php'; // para usar la sesion
include '../../models/getSpecialist.php'; // tengo al doctor, con su licencia y la especialidad
include '../../models/getServiceDays.php';
require_once '../models/getSpecialistById.php';

if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}


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


$doctores = obtenerEspecialistas();
//var_dump($doctores);
$dias = obtenerDias();
//var_dump($dias);

// Agregar funcion para traer las furaciones de los turnos y las franjas horarias
// poner las opciones en un select

$dias_semana = [
    1 => "Lunes",
    2 => "Martes",
    3 => "Miércoles",
    4 => "Jueves",
    5 => "Viernes",
    6 => "Sábado",
    7 => "Domingo"
];
$array_dias = [];
foreach ($dias as $dia) {
    $id = $dia['id'];
    if (isset($dias_semana[$id])) {
        $array_dias[] = $dias_semana[$id];
    }
}

//print_r($array_dias);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de doctores</title>
</head>
<body>
    <form action="../../controllers/manage-doctors.php" method="post">
        <select name="id_doctor" required>
            <option value="">Seleccione una duracion de turno</option>
            <?php
                if (!empty($doctores)) {
                    foreach ($doctores as $doctor) {
                        echo '<option value="' . htmlspecialchars($doctor['id']) . '">' . htmlspecialchars($doctor['name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No hay doctores disponibles</option>';
                }
            ?>
        </select>
        <br>
        <label for="text">Ingrese la duracion del turno (minutos)</label>
        <input type="number" name="duracion_del_turno" required>
        <br>
        <select name="dia" value="">
            <option value="">Seleccione un dia de la semana</option>
            <?php
            // Mostrar los días de la semana en un dropdown
            foreach ($dias_semana as $id => $dia) {
                echo "<option value='$id'>$dia</option>";
            }
            ?>
        </select>
        </select>
        <br>
        <label for="text">Ingrese la franja horaria de trabajo</label>
        <input type="time" name="desde" required>
        <input type="time" name="hasta" required>
        <br>
        <button type="submit">Cargar Disponibilidad</button>
    </form>
</body>
</html>