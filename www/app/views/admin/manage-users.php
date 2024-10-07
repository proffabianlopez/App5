<?php
include '../../models/connection.php';
include '../../controllers/login.php';
require_once '../../models/getContacts.php';
require_once '../../models/getAddress.php';
require_once '../../models/getPersons.php';
require_once '../../models/getNeighborhood.php';

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

$contactos = obtenerContactos();
//var_dump($contactos);
$address = obtenerDomicilios();
//var_dump($address);
$personas= obtenerPersonas();
//var_dump($personas);
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
                                    <h1 class="mainTitle">Administración | Vista Pacientes</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li>
                                        <span>Admin</span>
                                    </li>
                                    <li class="active">
                                        <span>Pacientes</span>
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
                                                <th class="center">Contacto</th>
                                                <th class="center">Calle</th>
                                                <th class="center">Número</th>
                                                <th class="center">Departamento</th>
                                                <th class="center">Piso</th>
                                                <th class="center">Barrio</th>
                                                <th class="center">D.N.I</th>
                                                <th class="center">Fecha de Nacimiento</th>
                                                <th class="center">Estado</th>
                                                <th class="center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $person = ObtenerPersonas();
                                            foreach ($person as $row) {
                                            ?>
                                                <tr class="center">
                                                    <td class="hidden-xs"><?php echo $row['name']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['surname']; ?></td>
                                                    <td class="hidden-xs"><?php
                                                    foreach($contactos as $contact){
                                                        if($contact['id_person'] == $row['id']){
                                                            echo $contact['contact'];
                                                        }
                                                    }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        foreach($address as $domicilio){
                                                            if($domicilio['id_person'] == $row['id']){
                                                                echo $domicilio['street'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        foreach($address as $domicilio){
                                                            if($domicilio['id_person'] == $row['id']){
                                                                echo $domicilio['number'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        foreach($address as $domicilio){
                                                            if($domicilio['id_person'] == $row['id']){
                                                                echo $domicilio['apartment'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        foreach($address as $domicilio){
                                                            if($domicilio['id_person'] == $row['id']){
                                                                echo $domicilio['floor'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php
                                                        foreach($address as $domicilio){
                                                            if($domicilio['id_person'] == $row['id']){
                                                                $barrio = ObtenerBarrio($domicilio['id_neighborhood']);
                                                                echo $barrio['name'];
                                                            }
                                                        }
                                                    ?></td>
                                                    <td class="hidden-xs"><?php echo $row['dni']; ?></td>
                                                    <td class="hidden-xs"><?php echo $row['birth_date']; ?></td>
                                                    <td class="hidden-xs"><?php
                                                        echo $row['status'];
                                                    ?></td>
                                                    <td class="hidden-xs">
                                                        <button type="button" class="btn-activate" data-id="<?php echo $row['id']; ?>">Activar usuario</button>
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
        <script src="../../../assets/js/activeUser.js"></script>
    </body>
</html>
