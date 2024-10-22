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
include '../../models/getAvailabilitySchedules.php';
include '../../models/getSpecialistById.php';
include '../../models/getSpecialities.php';
include '../../models/getHealthInsurance.php';
include '../../models/getUserAndPersons.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorId = $_GET['id'];
    $id_speciality = $_GET['idSpeciality'];
    $avalabilitySchedules = obtenerHorariosyDias($doctorId);
    $doctors = obtenerEspecialistaPorId($doctorId);
}

$specialities = obtenerEspecialidades();
foreach($specialities as $speciality){
    if($id_speciality == $speciality['id']){
        $doctorSpeciality = $speciality['speciality'];
    }
}
foreach($doctors as $doctor){
    $doctorName = $doctor['name'];
}

$obras_sociales = obtenerObraSocial();
$personas = obtenerUsuariosYPersonas();
//var_dump($personas);

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Admin | Asignar Turno</title>
        <?php include('../include/head.php'); ?> 
    </head>
    <body>
        <div id="app">		
            <?php include('../include/sidebar_admin.php'); ?>
            <div class="app-content">
                <?php include('../include/header.php'); ?>
                
                <div class="main-content">
                    <div class="wrap-content container" id="container">
                        <section id="page-title">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h1 class="mainTitle">Admin | Asignar Turno</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Admin</span></li>
                                    <li class="active"><span>Asignar Turno</span></li>
                                </ol>
                        </section>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <form id = "appointmentForm" role="form" name="book" method="post" action="../../controllers/insertAdminAppointment.php">
                                            <div class="form-group">
                                                <label for="doctor">Médico</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $doctorName; ?>">
                                                <input name="id_specialist" type="hidden" class="form-control" value="<?php echo $doctorId; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="DoctorSpecialization">Especialización Médico</label>
                                                <input id = "id_speciality" name="id_speciality" type="hidden" class="form-control" value="<?php echo $id_speciality; ?>">
                                                <input id = "speciality" name="speciality" type="text" class="form-control" readonly value="<?php echo $doctorSpeciality; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="consultancyfees">Paciente</label>
                                                <select name="paciente" class="form-control">
                                                         <?php
                                                          if (!empty($personas)) {
                                                                foreach ($personas as $persona) {
                                                                    echo '<option value="' . $persona['user_id'] . '">' . $persona['name'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay obras sociales cargadas cargados</option>';
                                                            }
                                                        ?>
                                                </select>
                                             </div>
                                            
                                            <div class="form-group">
                                                <label for="consultancyfees">Obra social</label>
                                                <select name="healthInsaurance" class="form-control">
                                                         <?php
                                                          if (!empty($obras_sociales)) {
                                                                foreach ($obras_sociales as $obraSocial) {
                                                                    echo '<option value="' . $obraSocial['id'] . '">' . $obraSocial['short_name'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay obras sociales cargadas cargados</option>';
                                                            }
                                                        ?>
                                                </select>
                                             </div>

                                            <div class="form-group">
                                                <label for="AppointmentDate">Fecha</label>
                                                <input id = "date" name="date" class="form-control datepicker" required data-date-format="dd-mm-yyyy" 
                                                onchange="updateAvailability();">
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="Appointmenttime">Hora</label>
                                                <input id = "time" name="time" type="time" class="form-control" required>
                                            </div> -->

                                            <button id = "button" type="submit" name="submit" class="btn btn-o btn-primary">Enviar</button>
                                        </form>
                                        <div id = "messaje"></div>
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

        <script>
            let diasSemana = {
                "1": "Lunes",
                "2": "Martes",
                "3": "Miércoles",
                "4": "Jueves",
                "5": "Viernes",
                "6": "Sábado",
                "7": "Domingo"
            };


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

            // Función que actualiza los dias disponibles
            function updateAvailability() {
                let selectedDate = document.querySelector('#date').value;
                let horario = <?php echo json_encode($avalabilitySchedules) ?>;
                let submitButton = document.querySelector('#button');
                let messageDiv = document.querySelector('#messaje');
            
            
                if (!selectedDate) {
                    messageDiv.innerHTML = '<p style="color:red;">Por favor, selecciona una fecha válida.</p>';
                    return;  // Salir si no hay fecha seleccionada
                }

                let dayName = getDayName(selectedDate); // Obtener el nombre del día a partir de la fecha seleccionada

                const dateParts = selectedDate.split('-'); // ["21", "10", "2024"]
                // Crear un nuevo objeto Date en el formato correcto (año, mes, día)
                const dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                const today = new Date();
                today.setHours(0, 0, 0, 0); // Establecer horas a 00:00 para comparar solo fechas

                // Calcular la fecha límite (20 días a partir de hoy)
                const limitDate = new Date(today);
                limitDate.setDate(today.getDate() + 20);

                submitButton.disabled = true; // Deshabilitar el botón por defecto
                messageDiv.innerHTML = ''; // Limpiar mensajes previos

                // Buscar el horario correspondiente para el día seleccionado
                let found = false; // Variable para saber si encontramos un horario válido
                for (let i = 0; i < horario.length; i++) {
                    let dia = horario[i]['dia_servicio_nombre']; // Nombre del día en el horario

                    // Verificar si el día coincide con el día de servicio
                    if (dayName === dia) {
                        submitButton.disabled = false; // Habilitar el botón si hay un horario disponible
                        found = true;
                        break;
                    }
                }

                if (dateObject >= today && dateObject <= limitDate) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                    messageDiv.innerHTML = '<p style="color:red;">La fecha no es válida. Debe ser igual o mayor a hoy y no más de 20 días a partir de hoy.</p>';
                }
                // Si no se encuentra un horario disponible para el día seleccionado, mostrar un mensaje de error
                if (!found) {
                    messageDiv.innerHTML = '<p style="color:red;">Por favor, selecciona un día habilitado para el médico.</p>';
                    submitButton.disabled = true;
                }
                if(horario == ""){
                    messageDiv.innerHTML = '<p style="color:red;">No hay horarios disponibles para este doctor. Seleccione otro.</p>';
                    submitButton.disabled = true;
                }
            }
        </script>


    </body>
</html>
