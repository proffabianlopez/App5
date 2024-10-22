<?php
session_start();

include '../../models/getSpecialities.php';
include '../../models/getSpecialistById.php';
include '../../models/getAppointmentsByUserId.php';
include '../../models/getSpecialist.php';
include '../../models/getHealthInsuranceById.php';
include '../../models/getPersonByUserId.php';

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
$specialist= obtenerEspecialistas();
$turnosDelUsario = obtenerTurnosPorUsuario($_SESSION['user']);
$persons = obtenerPersonasPorIdUsusario($_SESSION['user']);
foreach($persons as $person){
    $personaNombre = $person['name'];
    $personaApellido = $person['surname'];
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo $personaNombre; ?> | Lista De Turnos</title>
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
                                    <h1 class="mainTitle"><?php echo $personaNombre; ?> | Lista De Turnos</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span><?php echo $personaNombre; ?></span></li>
                                    <li class="active"><span>Lista De Turnos</span></li>
                                </ol>
                        </section>
                        
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                            <div class="col-md-12">
                                    <table class="table table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th class="center">Fecha</th>
                                                <th class="center">Hora</th>
                                                <th class="center">Doctor</th>
                                                <th class="center">Obra Social</th>
                                                <th class="center">Estado del turno</th>
                                                <th class="center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($turnosDelUsario as $row) {
                                                if($row['status'] == 0){
                                                    continue; // evitamos mostrar los doctores borrados
                                                }
                                            ?>
                                                <tr class="center">
                                                    <td class="hidden-xs"><?php echo date('d/m/Y', strtotime($row['date'])); ?></td>
                                                    <td class="hidden-xs"><?php echo $row['time']; ?></td>
                                                    <td class="hidden-xs"><?php
                                                    $doctors = obtenerEspecialistaPorId($row['id_specialist']);
                                                    foreach($doctors as $doctor){
                                                        echo $doctor['name']." ".$doctor['surname'];
                                                    }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php                                                   
                                                    $obrasSociales = obtenerObraSocialPorId($row['id_health_insurance']);
                                                    foreach($obrasSociales as $obraSocial){
                                                        echo $obraSocial['short_name'];
                                                    }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        if($row['status'] == 1){
                                                            echo 'Confirmado';
                                                        }
                                                        else{
                                                            echo 'Esperando Confirmacion';
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs">
                                                        <button type="button" class="btn-confirm" data-id="<?php echo $row['id']; ?>">Confirmar Turno</button>
                                                        <button type="button" class="btn-delete" data-id="<?php echo $row['id']; ?>">Cancelar Turno</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                    <div id="messaje"style="background-color: #f2dede; color: #a94442; border: 
                                    1px solid #ebccd1; padding: 15px; margin-top: 10px; border-radius: 4px; font-weight: bold; text-align: center;"></div>
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
        <script src="../../../assets/js/confirmAppointment.js"></script>
        <script src="../../../assets/js/cancelAppointment.js"></script>
    </body>
</html>