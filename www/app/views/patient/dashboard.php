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
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Usuario </title>
        
        <?php include '../include/head.php'; ?> 
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
                                    <h1 class="mainTitle">Usuario | Vista general</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Usuario</span>
                                    </li>
                                    <li class="active">
                                        <span>Vista general</span>
                                    </li>
                                </ol>
                            </div>
                        </section>
                        
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <h2 class="StepTitle">MI PERFIL</h2>
                                            
                                            <p class="links cl-effect-1">
                                                <a href="edit-profile.php">
                                                    Actualizar perfil
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <h2 class="StepTitle">MIS TURNOS</h2>
                                            
                                            <p class="cl-effect-1">
                                                <a href="appointment-history.php">
                                                    Ver mi historial de turnos
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="panel panel-white no-radius text-center">
                                        <div class="panel-body">
                                            <span class="fa-stack fa-2x">
                                                <i class="fa fa-square fa-stack-2x text-primary"></i>
                                                <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                            </span>
                                            <h2 class="StepTitle">RESERVAR TURNO</h2>
                                            
                                            <p class="links cl-effect-1">
                                                <a href="book-appointment.php">
                                                    Reservar turno
                                                </a>
                                            </p>
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
