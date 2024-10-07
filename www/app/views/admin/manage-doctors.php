<?php
include '../../controllers/login.php'; // para usar la sesion
include '../../models/getServiceDays.php';
require_once '../../models/getSpecialistById.php';
require_once '../../models/getAppointmentDuration.php';
require_once '../../models/getServiceHours.php';

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
        $doctorNombre = $doctor['name'];
    }
}

$dias = obtenerDias();
//var_dump($dias);
$duracion_turnos = obtenerDuracionDelTurno();
//var_dump($duracion_turnos);
$horarios_de_servicio = obtenerHorariosDeServicio();
//var_dump($horarios_de_servicio);

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
    <title> Admin | Administración del doctor</title>
	<?php include ('../include/head.php');?> 
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
                                                <form role="form" name="dcotorspcl" method="POST" action="../../controllers/manage-doctors.php">
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
                                                            <option value="">Seleccione un dia de la semana</option>
                                                            <?php
                                                            // Mostrar los días de la semana en un dropdown
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
                                                    <button type="submit" class="btn btn-o btn-primary">Agregar</button>
                                                </form>
                                            </div>
                                        </div>
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
</body>
</html>