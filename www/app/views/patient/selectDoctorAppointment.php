<?php
session_start();
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
require_once '../../models/getSpecilistBySpeciality.php';
require_once '../../models/getSpecialistById.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorSpeciality = $_GET['id'];
    $doctorsBySpeciality = obtenerEspecialistaPorEspecialidad($doctorSpeciality);
}
//var_dump($_SESSION);
//var_dump($doctorsBySpeciality);
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
                                    <h1 class="mainTitle">Usuario | Elija un Doctor</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Usuario</span></li>
                                    <li class="active"><span>Reservar Turno</span></li>
                                </ol>
                        </section>
                            <?php
                            if(!empty($doctorsBySpeciality)){
                                foreach($doctorsBySpeciality as $speciality){
                                    $doctors = obtenerEspecialistaPorId($speciality['id_specialist']);
                                    foreach($doctors as $doctor){?>
                                        <div class="col-sm-4">
                                            <div class="panel panel-white no-radius text-center">
                                                <div class="panel-body">
                                                    <span class="fa-stack fa-2x">
                                                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                        <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                    <h2 class="StepTitle"><?php echo $doctor['name'] ;?></h2>
                                                    
                                                    <p class="links cl-effect-1">
                                                        <a href="selectAppointment.php?id=<?php echo $doctor['id']; ?>&idSpeciality=<?php echo $doctorSpeciality; ?>">
                                                            <?php echo $doctor['surname'] ;?>
                                                        </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php        
                                    }
                                }
                            } else{?>
                                <div class="col-sm-4">
                                        <div class="panel panel-white no-radius text-center">
                                            <div class="panel-body">
                                                <span class="fa-stack fa-2x">
                                                    <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                    <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                                </span>
                                                <h2 class="StepTitle">No hay doctores disponibles para esta especialidad</h2>
                                                
                                                <p class="links cl-effect-1">
                                                <a href="book-appointment.php?">
                                                    Elegir otra especialidad
                                                </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div><?php
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