<?php
include '../../models/getSpecialities.php';
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

$license_types = obtenerTiposDeLicencias();
$specialities = obtenerEspecialidades();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Agregar Doctor</title>
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
                                <h1 class="mainTitle">Admin | Agregar Doctor</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Agregar Doctor</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                                <form role="form" action="../../controllers/add-doctor.php" method="POST">
                                                    <div class="form-group">
                                                        <label for="text">Realza consulta online?</label>
                                                        <select name="onlineConsultation">
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctorname">Nombre</label>
                                                        <input type="text" name="name" class="form-control" placeholder="Nombre" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctorname">Apellido</label>
                                                        <input type="text" name="surname" class="form-control" placeholder="Apellido" required>
                                                    </div>


                                                    <div class="form-group" required>
                                                        <label for="doctorname">Especialidad</label>
                                                        <select name="speciality" class="form-control">
                                                            <option value="">Seleccione un tipo de especialidad</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($specialities)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($specialities as $speciality) {
                                                                    echo '<option value="' . $speciality['id'] . '">' . $speciality['speciality'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay tipos de especialidades disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Calle</label>
                                                        <input type="text" name="street" class="form-control" placeholder="Juan XXIII" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Número</label>
                                                        <input type="text" name="number" class="form-control" placeholder="XXXXX" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fess">Departamento</label>
                                                        <input type="text" name="apartment" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fess">Piso</label>
                                                        <input type="text" name="floor" class="form-control">
                                                    </div>
                                                    <div class="form-group" required>
                                                        <label for="doctorname">Tipo de Matricula</label>
                                                        <select name="license_type" class="form-control">
                                                            <option value="">Seleccione un tipo de matrícula</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($license_types)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($license_types as $license) {
                                                                    echo '<option value="' . $license['id'] . '">' . $license['type'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay tipos de matrícula disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="doctorname">Matricula</label>
                                                        <input type="text" class="form-control" placeholder="MN XXXXXX" required name="license_number">
                                                    </div>

                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Cargar Doctor</button>
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

