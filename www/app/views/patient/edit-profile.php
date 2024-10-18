<?php
session_start();
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
//error_reporting(0);

include '../../models/getNeighborhood.php';
include '../../models/getContactsType.php';
include '../../models/getAddressType.php';
include '../../models/getContactById.php';
include '../../models/getAddressById.php';


$barrios = obtenerBarrio();
$tiposDeContactos = obtenerTiposDeContactos();
//var_dump($tiposDeContactos);
$tiposDeDomicilios = obtenerTiposDeDomicilios();
//var_dump($tiposDeDomicilios);
//var_dump($_SESSION);
$contact = obtenerContactoPorId($_SESSION['person']);
//var_dump($contact);
if(!empty($contact)){
    foreach($contact as $contactoPersona){
        $contactoP = $contactoPersona['contact'];
        $contactoTipo = $contactoPersona['id_contact_type'];
    }
} else{
    $contactoP = "";
    $contactoTipo = "";
}

$direcciones = obtenerDireccionPorId($_SESSION['person']);
if(!empty($direcciones)){
    foreach($direcciones as $direccion){
        $direccionTipo = $direccion['id_address_type'];
        $direccionCalle = $direccion['street'];
        $direccionNumero = $direccion['number'];
        $direccionDepto = $direccion['apartment'];
        $direccionPiso = $direccion['floor'];
        $direccionBarrio = $direccion['id_neighborhood'];
    }
}else{
    $direccionTipo = "";
    $direccionCalle = "";
    $direccionNumero = ""; 
    $direccionDepto = "";
    $direccionPiso = "";
    $direccionBarrio = "";
}

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
                                                <form id="editUserForm" role="form" name="edit" action="../../controllers/editProfileController.php" method="POST">

                                                    <input type="hidden" name="id_person" value="<?php echo $_SESSION['user']; ?>">

                                                    <div class="form-group">
                                                        <label for="id_address_type">Tipo de domicilio</label>
                                                        <select name="id_address_type" class="form-control">
                                                            <option value="">Seleccione un tipo de domicilio</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($tiposDeDomicilios)) {
                                                                foreach ($tiposDeDomicilios as $domicilio) {
                                                                    $selected = ($domicilio['id'] == $direccionTipo) ? 'selected' : '';
                                                                    echo '<option value="' . $domicilio['id'] . '" ' . $selected . '>' . $domicilio['type'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay barrios disponibles</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <span for="street">Calle</span>
                                                                <input type="text" name="street" class="form-control" required placeholder="Calle" value="<?php echo $direccionCalle ?>">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <span for="number">Número</span>
                                                                <input type="text" name="number" class="form-control" required placeholder="Número" value="<?php echo $direccionNumero ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="id_neighborhood">Barrio</label>
                                                        <div class="row">
                                                        <div class="col-md-8">
                                                        <select name="id_neighborhood" class="form-control">
                                                            <option value="">Seleccione un tipo barrio</option>
                                                            <?php
                                                            // Verificar si se obtuvieron resultados
                                                            if (!empty($barrios)) {
                                                            // Recorrer los tipos de licencia y generar las opciones
                                                                foreach ($barrios as $barrio) {
                                                                    $selected = ($barrio['id'] == $direccionBarrio) ? 'selected' : '';
                                                                    echo '<option value="' . $barrio['id'] . '" ' . $selected . '>' . $barrio['name'] . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">No hay barrios disponibles</option>';
                                                            }
                                                            ?>
                                                        </select> 
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class= "row">
                                                            <div class = "col-md-4">
                                                                <label for="apartment">Departamento</label>
                                                                <input type="text" name="apartment" class="form-control" value="<?php echo $direccionDepto ?>" placeholder = "Departamento" required>
                                                            </div>
                                                        
                                                            <div class = "col-md-4">
                                                            <label for="">Piso</label>
                                                                <input type="text" name="floor" class="form-control" required value="<?php echo $direccionPiso ?>" placeholder="Piso">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group">
                                                        <label for="contact">Número de Teléfono</label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input type="text" name="id_contact_type" class="form-control" placeholder="Código de área" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="3">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="contact" class="form-control" placeholder="Número de teléfono" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">

                                                        <select name="id_neighborhood" class="form-control">
                                                            <option value="">Seleccione un tipo barrio</option>
                                                            <php
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
                                                    </div>-->

                                                    <div class="form-group">
                                                        <label for="contact_type">Tipo de contacto</label>
                                                            <select name="id_contact_type" class="form-control">
                                                                <option value="">Seleccione un tipo de contacto</option>
                                                                <?php
                                                                // Verificar si se obtuvieron resultados
                                                                if (!empty($tiposDeContactos)) {
                                                                    foreach ($tiposDeContactos as $contacto) {
                                                                        $selected = ($contacto['id'] == $contactoTipo) ? 'selected' : '';
                                                                        echo '<option value="' . $contacto['id'] . '" ' . $selected . '>' . $contacto['type'] . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">No hay tipos de contactos disponibles</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact">Ingrese su contacto</label>
                                                        <input type="text" name="contact" class="form-control" required value="<?php echo $contactoP; ?>">
                                                    </div>

                                                    <button id = "button" type="submit" name="submit" class="btn btn-o btn-primary">Actualizar</button>
                                                </form>
                                                <div id="message"></div>                                                
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
    <script src="../../../assets/js/updateUser.js"></script>
</body>

</html>
