<?php
error_reporting(0);
include '../../controllers/login.php';
include '../../models/getNeighborhood.php';
include '../../models/getContactsType.php';
include '../../models/getAddressType.php';

if (!isset($_SESSION)) {
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
} else {
    session_start();
}

//var_dump($_SESSION);
//$_SESSION['user'];
//$_SESSION['rol'];
//include('include/config.php');
//include('include/checklogin.php');
//check_login();

if (empty($_SESSION)) {
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

$barrios = obtenerBarrio();
$tiposDeContactos = obtenerTiposDeContactos();
//var_dump($tiposDeContactos);
$tiposDeDomicilios = obtenerTiposDeDomicilios();
//var_dump($tiposDeDomicilios);
?> 

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Usuario | Editar Perfil</title>
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
                                <h1 class="mainTitle">Usuario | Editar Perfil</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Usuario</span></li>
                                <li class="active"><span>Editar Perfil</span></li>
                            </ol>
                        </div>
                    </section>
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px;"></h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Editar perfil de usuario</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="edit" action="../../controllers/editProfileController.php" method="POST">
                                                    <div class="form-group">
                                                        <label for="street">Calle</label>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="text" name="street" class="form-control" required placeholder="Calle">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" name="number" class="form-control" required placeholder="Número">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="id_neighborhood">Barrio</label>
                                                        <select name="id_neighborhood" class="form-control">
                                                            <option value="">Seleccione un tipo barrio</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($barrios)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($barrios as $barrio) {
                                                                    echo '<option value="' . $barrio['id'] . '">' . $barrio['name'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay barrios disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_address_type">Tipo de domicilio</label>
                                                        <select name="id_address_type" class="form-control">
                                                            <option value="">Seleccione un tipo de domicilio</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($tiposDeDomicilios)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($tiposDeDomicilios as $domicilio) {
                                                                    echo '<option value="' . $domicilio['id'] . '">' . $domicilio['type'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay barrios disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="floor">Piso</label>
                                                        <input type="text" name="floor" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apartment">Departamento</label>
                                                        <input type="text" name="apartment" class="form-control" value="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="contact_type">Tipo de contacto</label>
                                                        <select name="id_contact_type" class="form-control">
                                                            <option value="">Seleccione un tipo de contacto</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($tiposDeContactos)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($tiposDeContactos as $contacto) {
                                                                    echo '<option value="' . $contacto['id'] . '">' . $contacto['type'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay tipos de contactos disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact">Ingrese su contacto</label>
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <input type="text" name="contact" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Actualizar</button>
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
