<?php
session_start();

include '../../models/getSpecialities.php';
include '../../models/getAppointmentDuration.php';
include '../../models/getServiceDays.php';
include '../../models/getServiceHours.php';
include '../../models/getSpecialist.php';
include '../../models/getSpecialistById.php';

if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '2') {
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
                                    <h1 class="mainTitle">Admin | Elija una especialidad</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Admin</span></li>
                                    <li class="active"><span>Asignar Turno</span></li>
                                </ol>
                        </section>
                            <?php
                            foreach($specialities as $speciality){
                                ?> <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle"><?php echo $speciality['speciality'] ;?></h2>
                                        
                                        <p class="links cl-effect-1">
                                            <a href="selectDoctor.php?id=<?php echo $speciality['id'];?>">
                                            <?php echo $speciality['speciality'] ;?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div> <?php
                            }
                            ?>
                        
                    </div>
                </div>
            </div>
            <?php include('../include/footer.php'); ?>
            <?php include('../include/setting.php'); ?>
        </div>
        <?php include('../include/script.php'); ?> 

    </body>
</html>
