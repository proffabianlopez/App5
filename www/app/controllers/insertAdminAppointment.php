<?php
session_start();
if (isset($_SESSION)) {
    if ($_SESSION['rol'] == "" || $_SESSION['rol'] != '2') {
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

include '../models/getAvailabilitySchedules.php';
include '../models/getAppointmentByDay.php';
include '../models/insertAppointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //var_dump($_POST);
    // Capturar los datos enviados desde el formulario
    $doctorId = $_POST['id_specialist'];
    $speciality = $_POST['id_speciality'];
    $date = $_POST['date']; // Formato dd-mm-yyyy
    $idUser = $_POST['paciente'];
    //$time = $_POST['time'];
    $healthInsaurance = $_POST['healthInsaurance'];
    $date = $_POST['date']; // Fecha en formato dd-mm-yyyy

    // Dividimos la fecha por los guiones
    $dateParts = explode('-', $date);

    // Reorganizamos a formato yyyy-mm-dd
    $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];

    $cantDeTurnosDelDia = obtenerTurnosDelDia($formattedDate);

    //echo "Datos enviados: $doctorId - $speciality - $formattedDate - $healthInsaurance - Cantidad de turnos tomados en este dia: $cantDeTurnosDelDia";
} else {
    echo "Metodo de envio invalido";
}

$dateTime = new DateTime($formattedDate);

// Obtener el número del día de la semana (0=domingo, 6=sábado)
$dayOfWeek = $dateTime->format('w'); // Devuelve el día de la semana como número

// Array de días de la semana en español
$diasEnEspanol = [
    'Domingo',
    'Lunes',
    'Martes',
    'Miércoles',
    'Jueves',
    'Viernes',
    'Sábado',
];

// Obtener el nombre del día en español
$dayName = $diasEnEspanol[$dayOfWeek];
//echo $dayName;

$avalabilitySchedules = obtenerHorariosyDias($doctorId);

foreach ($avalabilitySchedules as $row) {
    if($dia_servicio = $row['dia_servicio_nombre'] == $dayName){
        $horaInicio = substr($row['hora_inicio'], 0, 5);
        $horaFin = substr($row['hora_fin'], 0, 5);
        $duracionTurno = $row['duracion_turno'];
    }
    
}
//echo "$horaInicio - $horaFin - $duracionTurno"; 

// Función para convertir hora en formato HH:MM a minutos
function convertirAHorasAMinutos($hora) {
    list($horas, $minutos) = explode(':', $hora); // Divide la hora en horas y minutos
    return ($horas * 60) + $minutos; // Convierte todo a minutos
}

// Convertir hora de inicio y fin a minutos
$minutosInicio = convertirAHorasAMinutos($horaInicio);
$minutosFin = convertirAHorasAMinutos($horaFin);

// Calcular la duración total de la franja horaria en minutos
$duracionFranjaHoraria = $minutosFin - $minutosInicio;

// Calcular cuántos turnos caben en la franja horaria
if ($duracionTurno > 0) {
    $numTurnos = floor($duracionFranjaHoraria / $duracionTurno); // Usamos floor para obtener un número entero
} else {
    $numTurnos = 0; // Si la duración del turno es 0, no hay turnos posibles
}

// Mostrar el resultado
//echo "En la franja horaria de $horaInicio a $horaFin, caben $numTurnos turnos de $duracionTurno minutos.";

if($cantDeTurnosDelDia >= $numTurnos){
    echo '<script type="text/javascript">';
        echo 'alert("ya no podemos tomar más turnos para la fecha solicitada");';
        echo 'window.location.href="../views/admin/asignAppointment.php?id=' . $doctorId . '&idSpeciality=' . $speciality . '";';
        echo '</script>';
        exit();
} else{
    $time = "";
    //echo "insertamos su turno exitosamente $formattedDate - $time - $doctorId - ".$_SESSION['user']." - $healthInsaurance";
    $responde = insertAppointment($formattedDate, $time, $doctorId, $idUser, $healthInsaurance);
    if($responde){
        //var_dump("$formattedDate - $time - $doctorId - $idUser - $healthInsaurance");
        echo '<script type="text/javascript">';
        echo 'alert("Turno tomado con exito");';
        echo 'window.location.href="../views/admin/asignAppointment.php?id=' . $doctorId . '&idSpeciality=' . $speciality . '";';
        echo '</script>';
        exit();
    } else{
        echo '<script type="text/javascript">';
        echo 'alert("Hubo un problema al tomar el turno, hable con el administrador");';
        echo 'window.location.href="../views/admin/asignAppointment.php?id=' . $doctorId . '&idSpeciality=' . $speciality . '";';
        echo '</script>';
        exit();
    }
    // datos que se van a insertar para el turno $doctorId - $speciality - $formattedDate - $healthInsaurance $_SESSION['user'];
    // $speciality, deberia agregar en un futuro la especialidad asignada

}

?>