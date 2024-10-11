<?php
session_start();
include '../../controllers/login.php';
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
                                                    <input type="hidden" name="id_person" value="<?php echo $_SESSION['user_id']; ?>">
                                                    <div class="form-group">
                                                        <label for="street">Calle</label>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <input type="text" name="street" class="form-control" required="required" placeholder="calle" value="">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="text" name="number" class="form-control" required="required" placeholder="Número" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="5">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="id_neighborhood">Barrio</label>
                                                        <input type="text" name="id_neighborhood" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="floor">Piso</label>
                                                        <input type="number" name="floor" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apartment">Departamento</label>
                                                        <input type="number" name="apartment" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="contact">Número de Teléfono</label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input type="text" name="id_contact_type" class="form-control" placeholder="Código de área" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="3">
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="contact" class="form-control" placeholder="Número de teléfono" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">
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

            <?php include('../include/footer.php'); ?>
            <?php include('../include/setting.php'); ?>
        </div>
    </div>
    <?php include('../include/script.php'); ?>
</body>

</html>
