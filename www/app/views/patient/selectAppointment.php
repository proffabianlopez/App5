<?php
session_start();
if (isset($_SESSION)) {
    if ($_SESSION['rol'] == "" || $_SESSION['rol'] != '1') {
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
include '../../models/getAvailabilitySchedules.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorId = $_GET['id'];
    $avalabilitySchedules = obtenerHorariosyDias($doctorId);
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Usuario | Reservar Turno</title>
        <?php include('../include/head.php'); ?> 
    </head>
    <body>
        <div id="app">		
            <?php include('../include/sidebar_patient.php'); ?>
            <div class="app-content">
                <?php include('../include/header.php'); ?>
                
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Usuario | Reservar Turno</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Usuario</span></li>
                                    <li class="active"><span>Reservar Turno</span></li>
                                </ol>
                        </section>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <form role="form" name="book" method="post" action="../../controllers/insertAppointment.php">
                                            <div class="form-group">
                                                <label for="doctor">Médico</label>
                                                <input name="id_specialist" type="text" class="form-control" readonly value="Angel">
                                            </div>

                                            <div class="form-group">
                                                <label for="DoctorSpecialization">Especialización Médico</label>
                                                <input name="id_speciality" type="text" class="form-control" readonly value="Clinico">
                                            </div>                                            

                                            <div class="form-group">
                                                <label for="consultancyfees">Obra social</label>
                                                <select name="fees" class="form-control" id="fees" readonly></select>
                                            </div>

                                            <div class="form-group">
                                                <label for="AppointmentDate">Fecha</label>
                                                <input name="date" class="form-control datepicker" required data-date-format="dd-mm-yyyy" 
                                                onchange="updateAvailability();">

                                            </div>

                                            <div class="form-group">
                                                <label for="Appointmenttime">Hora</label>
                                                <input name="time" type="time" class="form-control" id="timepicker1" required>
                                            </div>

                                            <button type="submit" name="submit" class="btn btn-o btn-primary">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <table class="table table-hover" id="sample-table-1">
                                            <thead>
                                                <tr>
                                                    <th class="center">Días de atención</th>
                                                    <th class="center">Horarios de atención</th>
                                                    <th class="center">Duración de atención</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($avalabilitySchedules as $row) {
                                                ?>
                                                    <tr class="center">
                                                        <td class="hidden-xs"><?php echo $row['dia_servicio_nombre']; ?></td>
                                                        <td class="hidden-xs"><?php echo substr($row['hora_inicio'], 0, 5) . " - " . substr($row['hora_fin'], 0, 5) ; ?></td>
                                                        <td class="hidden-xs"><?php echo $row['duracion_turno']; ?> minutos</td>
                                                    </tr>
                                                <?php
                                                } ?>
                                            </tbody>
                                        </table>
                                        <div id="messaje"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <?php include('../include/footer.php'); ?>
            <?php include('../include/setting.php'); ?>
        </div>
        <?php include('../include/script.php'); ?>

        <?php
        // Array PHP con los días de la semana
        $dias_semana = [
            1 => "Lunes",
            2 => "Martes",
            3 => "Miércoles",
            4 => "Jueves",
            5 => "Viernes",
            6 => "Sábado",
            7 => "Domingo"
        ];
        ?>
        <script>
            // Convertimos el array de PHP a JavaScript
            let diasSemana = <?php echo json_encode($dias_semana); ?>;

            // Función que obtiene el nombre del día de la semana a partir de una fecha
            function getDayName(dateString) {
                const dateParts = dateString.split('-'); // Formato dd-mm-yyyy
                const dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // Crear objeto Date
                const dayIndex = dateObject.getDay(); // Obtener el índice del día (0 para Domingo, 1 para Lunes, etc.)
                
                // En JavaScript, Domingo es 0, pero en tu array Domingo es 7, así que hacemos el ajuste
                const adjustedDayIndex = (dayIndex === 0) ? 7 : dayIndex;
                
                // Devolvemos el nombre del día en español usando el array de PHP convertido a JS
                return diasSemana[adjustedDayIndex];
            }

            // Función que actualiza los valores de min, max y step en el campo de hora según la fecha seleccionada
            function updateAvailability() {
                let selectedDate = document.querySelector('.datepicker').value;
                let horario = <?php echo json_encode($avalabilitySchedules); ?>;
                let timeInput = document.getElementById('timepicker1');

                // Obtener el nombre del día a partir de la fecha seleccionada
                let dayName = getDayName(selectedDate);

                // Buscar el horario correspondiente para el día seleccionado
                for (let i = 0; i < horario.length; i++) {
                    let dia = horario[i]['dia_servicio_nombre']; // Nombre del día en el horario

                    // Verificar si el día coincide con el día de servicio
                    if (dayName === dia) {
                        timeInput.min = horario[i]['hora_inicio'];
                        timeInput.max = horario[i]['hora_fin'];
                        timeInput.step = horario[i]['duracion_turno'] * 60; // Duración en segundos
                        break;
                    }
                }
            }
        </script>

    </body>
</html>
