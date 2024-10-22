<?php
include '../../models/getSpecialities.php';
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

$especialidades = obtenerEspecialidades();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | DoctoresEsp.</title>
    <?php include ('../include/head.php'); ?> 
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
                                <h1 class="mainTitle">Administrador | Agregar especialización médica</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Agregar especialización</span>
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
                                                <h5 class="panel-title">Especialización de doctores</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="dcotorspcl" method="post" action="../../controllers/doctor-specilization.php">
                                                    <div class="form-group">
                                                        <label for="especialidad">Especialización de doctores</label>
                                                        <input required type="text" name="especialidad" class="form-control" placeholder="Especialidades" pattern="[A-Za-zÑñÁáÉéÍíÓóÚú\s]+" inputmode="text">
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Agregar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-body">
                                                <table class="table table-hover" id="sample-table-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Especialidades</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $especialidad = obtenerEspecialidades();
                                                        foreach ($especialidad as $row) {
                                                        ?>
                                                            <tr class="center">
                                                                <td class="hidden-xs"><?php echo $row['speciality']; ?></td>
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
            <?php include('../include/setting.php'); ?>
            <?php include('../include/footer.php'); ?>
    </div>
    <?php include('../include/script.php'); ?> 
    <script>
        // Función para leer parámetros de la URL
        function getQueryParam(param) {
            let urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Mostrar alerta si el parámetro 'status' es 'success'
        window.onload = function() {
            const status = getQueryParam('status');
            if (status === 'success') {
                alert('Carga exitosa');
            }
        };
    </script>
</body>
</html>
