<?php
session_start();
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

include '../../models/getServiceHours.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Admin | Horarios de atención</title>
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
                                <h1 class="mainTitle">Administrador | Agregar horario de atención</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Agregar horario de atención</span>
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
                                                <h5 class="panel-title">Horarios de atención</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form id="serviceForm" role="form" name="dcotorspcl" method="POST" action="../../controllers/addServiceHours.php">
                                                    <div class="form-group">
                                                        <label for="start time">Inicio de horario de atención</label>
                                                        <input id="desde" type="time" name="desde" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="end time">Final de horario de atención</label>
                                                        <input id="hasta" type="time" name="hasta" class="form-control" required>
                                                    </div>
                                                    <button type="submit" id="submitButton" class="btn btn-o btn-primary">Agregar</button>
                                                </form>
                                                <div id="messaje"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <!-- <div class="panel-heading">
                                                <h5 class="panel-title">Franja horaria</h5>
                                            </div> -->
                                            <div class="panel-body">
                                            <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Horarios de atención</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $horaiosAtencion = obtenerHorariosDeServicio();
                                                        foreach ($horaiosAtencion as $row) {
                                                        ?>
                                                            <tr class="center">
                                                                <td class="hidden-xs"><?php echo $row['start_time']. " - ". $row['end_time']; ?></td>
                                                            </tr>
                                                        <?php
                                                        } ?>
                                                    </tbody>
                                            </table>
                                            
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
    <script src="../../../assets/js/addServiceHours.js"></script>
</body>
</html>
