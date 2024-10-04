<?php
include '../../models/connection.php';
include '../../controllers/login.php';
require_once '../../models/getSpecialist.php';
if (!isset($_SESSION)) {
    echo "redireccionando";
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}
//var_dump($_SESSION);
if (empty($_SESSION)) {
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

$doctores = obtenerEspecialistas();
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
                                                <th class="center">Calle</th>
                                                <th class="center">Número</th>
                                                <th class="center">Departamento</th>
                                                <th class="center">Piso</th>
                                                <th class="center">Matricula</th>
                                                <th class="center">Estado</th>
                                                <th class="center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($doctores as $row) {
                                            ?>
                                                <tr class="center">
                                                    <td class="hidden-xs"><?php echo $row['name']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['surname']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['street']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['number']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['apartment']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['floor']; ?></td>
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
                                                    <td class="hidden-xs">
                                                        <button type="button" class="btn-activate" data-id="<?php echo $row['id']; ?>">Activar doctor</button>
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
        </div>

        <?php include('../include/footer.php'); ?>
        <?php include('../include/setting.php'); ?>
        
        <?php include('../include/script.php'); ?> 
        <script src="../../../assets/js/activeDoctor.js"></script>
    </body>
</html>
