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

require_once '../../models/getSpecialistById.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $doctorId = $_GET['id'];
    $doctors = obtenerEspecialistaPorId($doctorId);
    // ejemplo de como obtener cada campo del doctor con su id
    // usar mas funciones en caso de querer actualizar más cosas
    foreach($doctors as $doctor){
        $doctorNombre = $doctor['name'];
    }
}


include '../../models/getNeighborhood.php';
include '../../models/getContactsType.php';
include '../../models/getAddressType.php';


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
                                                <h5 class="panel-title">Información personal de <?php echo $doctorNombre; ?></h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="dcotorspcl" method="POST" action="../../controllers/manage-doctors.php">
                                                    <!-- Campo oculto para enviar el ID del doctor -->
                                                    <input type="hidden" name="id_doctor" value="<?php echo $doctorId; ?>">
                                                    <div class="form-group">
                                                        Nombre y Apellido
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text" name="name" class="form-control" required placeholder="Nombre">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" name="surname" class="form-control" required placeholder="Apellido">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        Realiza consultas online?
                                                        <select name="onlineConsultation" id="onlineConsultation" class="form-group">
                                                            <option value="1">Si</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        Calle y Número
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="text" name="street" class="form-control" required placeholder="Calle">
                                                            </div>
                                                            <div class="col-md-4">
                                                            <input type="text" name="number" class="form-control" required placeholder="Número">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        Departamento y Piso
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            <input type="text" name="apartment" class="form-control" required placeholder="Departamento">
                                                            </div>
                                                            <div class="col-md-4">
                                                            <input type="text" name="floor" class="form-control" required placeholder="Piso">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-o btn-primary">Modificar</button>
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


