<?php
session_start();

include '../../models/getSpecialities.php';
include '../../models/getAppointmentDuration.php';
include '../../models/getServiceDays.php';
include '../../models/getServiceHours.php';
include '../../models/getSpecialist.php';
include '../../models/getSpecialistById.php';

if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '1') {
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

$specialities = obtenerEspecialidades();
$appointmentDuration = obtenerDuracionDelTurno();
$serviceDays = obtenerDias();
$serviceHours = obtenerHorariosDeServicio();
$specialist= obtenerEspecialistas();
// $idspecialist =obtenerEspecialistaPorId();
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
                        
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Reservar Turno</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <form role="form" name="book" method="post">
                                                        <div class="form-group">
                                                            <label for="DoctorSpecialization">Especialización Médico</label>
                                                            <select name="speciality" class="form-control" onChange="getdoctor(this.value);" required="required">
                                                                <option value="">Selecionar Especialización</option>
                                                                <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($specialities)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($specialities as $speciality) {
                                                                    #idspeciality = $speciality['id']
                                                                    echo '<option value="' . $speciality['id'] . '">' . $speciality['speciality'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay tipos de especialidades disponibles</option>';
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="doctor">Médico</label>
                                                            <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
                                                                <option value="">Seleccionar Médico</option>
                                                                <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($specialist)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($idspeciality as $idspecia) {
                                                                    echo '<option value="' . $speciality['id'] . '">' . $speciality['speciality'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay tipos de especialidades disponibles</option>';
                                                            }
                                                            ?>
                                                            </select>
                                                        </div>

                                                        <!-- OBRASOCIAL -->
                                                        <div class="form-group">
                                                            <label for="consultancyfees">Obra social</label>
                                                            <select name="fees" class="form-control" id="fees" readonly></select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="AppointmentDate">fecha</label>
                                                            <input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd">
                                                        </div>

                                                        <?php
                                                        //AJAX para mostrar los horarios disponibles
                                                        ?>

                                                        <div class="form-group">
                                                            <label for="Appointmenttime">hora</label>
                                                            <input class="form-control" name="apptime" id="timepicker1" required="required">
                                                            <small>ej : 10:00 PM</small>
                                                        </div>														
                
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Enviar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

    </body>
</html>
<?php
//ajax para
?>