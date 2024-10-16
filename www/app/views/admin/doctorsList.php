<?php
session_start();
include '../../models/connection.php'; 
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

$doctores = obtenerEspecialistas();
// $especialistaid = obtenerEspecialistaPorId ($id);
//var_dump($doctores);
?>

<!DOCTYPE html>
<html lang="en">
    <?php include ('../include/head.php'); ?> 
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
                                    <h1 class="mainTitle">Administración | Vista Doctores</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Doctores</span>
                                    </li>
                                </ol>
                                <div>
                                    <a href="../admin/add-doctor.php">
                                        <button type="button">Agregar Doctor</button>
                                    </a>
                                </div>
                            </div>
                        </section>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover" id="sample-table-1">
                                        <thead>
                                            <tr>
                                                <th class="center">Nombre</th>
                                                <th class="center">Apellido</th>
                                                <!-- <th class="center">Calle</th>
                                                <th class="center">Número</th>
                                                <th class="center">Departamento</th>
                                                <th class="center">Piso</th> -->
                                                <th class="center">Realiza Constulta online</th>
                                                <th class="center">Estado</th>
                                                <!-- <th class="center">Especialidades</th> -->
                                                <th class="center">Acción</th>
                                                <th class="center">Agregar Dias y Fechas de trabajo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($doctores as $row) {
                                                if($row['status'] == 0){
                                                    continue; // evitamos mostrar los doctores borrados
                                                }
                                            ?>
                                                <tr class="center">
                                                    <td class="hidden-xs"><?php echo $row['name']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['surname']; ?></td>
                                                    <!-- <td class="hidden-xs"><?php echo $row['street']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['number']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['apartment']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['floor']; ?></td> -->
                                                    <td class="hidden-xs"><?php
                                                        $onlineConsultation = $row['online_consultation'];
                                                        if($onlineConsultation == 1){
                                                            echo 'Realiza consultas online';
                                                        }
                                                        else{
                                                            echo 'No realiza consultas online';
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        if($row['status'] == 1){
                                                            echo 'Activo';
                                                        }
                                                        else{
                                                            echo 'Inactivo';
                                                        }
                                                    ?></td>
                                                    <!-- <td> -->
                                                    <!-- <div class="dropdown">
                                                        <button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Especialidades
                                                        <span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                        <?php
                                                            if (!empty($specialities)) {
                                                                foreach ($specialities as $speciality) {
                                                                    echo '<li value="' . $speciality['id'] . '">' . $speciality['speciality'] . '</li>';
                                                                }
                                                            } else {
                                                                echo '<li value="">No hay tipos de especialidades disponibles</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>     -->
                                                    <!-- </td> -->
                                                    <td class="hidden-xs">
                                                        <button type="button" class="btn-activate" data-id="<?php echo $row['id']; ?>">Activar doctor</button>
                                                        <button type="button" class="btn-delete" data-id="<?php echo $row['id']; ?>">Borrar doctor</button>
                                                        <button type="button" class="btn-modificar" onclick="window.location.href='editDoctor.php?id=<?php echo $row['id']; ?>'">Modificar Doctor</button>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn-modificar" onclick="window.location.href='manage-doctors.php?id=<?php echo $row['id']; ?>'">Horarios y Dias de trabajo</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                    <div id="messaje"></div>
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
        <script src="../../../assets/js/activeDoctor.js"></script>
        <script src="../../../assets/js/deleteDoctor.js"></script>
    </body>
</html>
