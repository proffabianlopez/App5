<?php
session_start();
include '../../models/connection.php'; 
include '../../models/getSpecialist.php';
include '../../models/getSpecialistById.php';

if (isset($_SESSION)) {
    if (($_SESSION['rol']) == "" or $_SESSION['rol'] != '2') {
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
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../include/head.php'); ?> 
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
                        <br>
                        <br>
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="dataTabledoctorList" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="center">Nombre</th>
                                                <th class="center">Apellido</th>
                                                <th class="center">Realiza Constulta online</th>
                                                <th class="center">Estado</th>
                                                <th class="center">Acción</th>
                                                <th class="center">Agregar Dias y Fechas de trabajo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($doctores as $row) {
                                                if ($row['status'] == 0) {
                                                    continue;
                                                }
                                            ?>
                                            <tr class="center">
                                                <td class="hidden-xs"><?php echo $row['name']; ?></td>
                                                <td class="hidden-xs"><?php echo $row['surname']; ?></td>
                                                <td class="hidden-xs">
                                                    <?php
                                                    $onlineConsultation = $row['online_consultation'];
                                                    if ($onlineConsultation == 1) {
                                                        echo 'Realiza consultas online';
                                                    } else {
                                                        echo 'No realiza consultas online';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <?php
                                                    if ($row['status'] == 1) {
                                                        echo 'Activo';
                                                    } else {
                                                        echo 'Inactivo';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="hidden-xs">
                                                    <button type="button" class="btn btn-success" title="Ver detalles" data-toggle="modal" data-target="#doctorListModal" data-id="<?php echo $row['id']; ?>" onclick="showDoctorDetails(<?php echo $row['id']; ?>)">
                                                        <i class="ti-eye text-bold" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-info" title="Activar Doctor" data-id="<?php echo $row['id']; ?>">
                                                        <i class="ti-check text-bold" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" title="Borrar Doctor" data-id="<?php echo $row['id']; ?>"> 
                                                        <i class="ti-trash" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-primary" title="Modificar Doctor" onclick="window.location.href='editDoctor.php?id=<?php echo $row['id']; ?>'">
                                                        <i class="ti-pencil-alt" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info" title="Horarios y días de trabajo" onclick="window.location.href='manage-doctors.php?id=<?php echo $row['id']; ?>'">
                                                        <i class="ti-calendar" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php } ?>
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

            <!-- Modal de los detalles del doctor -->
            <div class="modal fade" id="doctorListModal" tabindex="-1" role="dialog" aria-labelledby="doctorListModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="doctorListModalLabel">Información del Médico</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php 
                            foreach ($doctores as $row) {
                                if ($row['status'] == 0) {
                                    continue;
                                }
                            ?>
                                <p class="hidden-xs" data-id="<?php echo $row['id']; ?>"></p>
                                <p class="hidden-xs"><strong>Nombre: </strong><?php echo $row['name']; ?></p>
                                <p class="hidden-xs"><strong>Apellido: </strong><?php echo $row['surname']; ?></p>
                                <p class="hidden-xs"><strong>Calle: </strong><?php echo $row['street']; ?></p>
                                <p class="hidden-xs"><strong>Número: </strong><?php echo $row['number']; ?></p>
                                <p class="hidden-xs"><strong>Departamento: </strong><?php echo $row['apartment']; ?></p>
                                <p class="hidden-xs"><strong>Piso: </strong><?php echo $row['floor']; ?></p>
                                <p class="hidden-xs"><strong>Consulta online: </strong>
                                    <?php 
                                    $onlineConsultation = $row['online_consultation'];
                                    if ($onlineConsultation == 1) {
                                        echo 'Realiza consultas online';
                                    } else {
                                        echo 'No realiza consultas online';
                                    }
                                    ?>
                                </p>
                                <p class="hidden-xs"><strong>Estado: </strong>
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo 'Activo';
                                    } else {
                                        echo 'Inactivo';
                                    }
                                    ?>
                                </p>
                                <p class="hidden-xs">
                                    <strong>Especialidades: </strong>
                                    <button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                                        Especialidades
                                        <span class="caret"></span>
                                    </button>
                                </p>
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include('../include/script.php'); ?> 
        <script src="../../../assets/js/activeDoctor.js"></script>
        <script src="../../../assets/js/deleteDoctor.js"></script>
        <script>
            new DataTable('#dataTabledoctorList');
        </script>
        
    </body>
</html>