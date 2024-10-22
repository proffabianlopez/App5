<?php
session_start();
include '../../models/getServiceDays.php';
require_once '../../models/getSpecialistById.php';
require_once '../../models/getAppointmentDuration.php';
require_once '../../models/getServiceHours.php';
require_once '../../models/getAvailabilitySchedules.php';

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

if (empty($_SESSION)) {
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorId = $_GET['id'];
    $doctors = obtenerEspecialistaPorId($doctorId);
    foreach ($doctors as $doctor) {
        $doctorNombre = $doctor['name'];
    }
}

$dias = obtenerDias();
$duracion_turnos = obtenerDuracionDelTurno();
$horarios_de_servicio = obtenerHorariosDeServicio();
$hs_disponibilidad = obtenerHorariosyDias($doctorId);

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Administración del doctor</title>
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
                                <h1 class="mainTitle">Administrador | Administración del doctor</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Administración del doctor</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Dia laboral de <?php echo $doctorNombre; ?></h5>
                                            </div>
                                            <div class="panel-body">
                                                <form id = "form" role="form" name="dcotorspcl" method="POST" action="../../controllers/manage-doctors.php">
                                                    <!-- Campo oculto para enviar el ID del doctor -->
                                                    <input type="hidden" name="id_doctor" value="<?php echo htmlspecialchars($doctorId); ?>">
                                                    <div class="form-group">
                                                        <select name="duracion_turno" required>
                                                            <option value="">Seleccione una duracion de turno</option>
                                                            <?php
                                                                if (!empty($duracion_turnos)) {
                                                                    foreach ($duracion_turnos as $turno) {
                                                                        echo '<option value="' . htmlspecialchars($turno['id']) . '">' . htmlspecialchars($turno['appointment_duration']) . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">No hay duración de turnos cargados</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="dia" value="">
                                                            <option value="">Seleccione un día de la semana</option>
                                                            <?php
                                                                foreach ($dias_semana as $id => $dia) {
                                                                    echo "<option value='$id'>$dia</option>";
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="horario_atencion" value="">
                                                            <option value="">Seleccione una franja horaria</option>
                                                            <?php
                                                                if (!empty($horarios_de_servicio)) {
                                                                    foreach ($horarios_de_servicio as $horario) {
                                                                        echo '<option value="' . htmlspecialchars($horario['id']) . '">' . htmlspecialchars($horario['start_time'])." - ". $horario['end_time'] . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">No hay horarios cargados</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <button id = "submitButton" type="submit" class="btn btn-o btn-primary">Agregar</button>
                                                </form>
                                                <div id="messaje"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Día atención</th>
                                                    <th>Horario</th>
                                                    <th>Duración del turno</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Recorrer los horarios y días disponibles del doctor
                                                foreach ($hs_disponibilidad as $horario) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($horario['dia_servicio_nombre']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($horario['hora_inicio']) . " - " . htmlspecialchars($horario['hora_fin']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($horario['duracion_turno']) . "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white"></div>
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
        new DataTable('#example');
    </script>
    <script src="../../../assets/js/manage-doctors.js"></script>
</body>
</html>
