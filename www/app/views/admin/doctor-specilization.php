<?php
error_reporting(0);
include '../../controllers/login.php';
if(!isset($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}
else{
    session_start();
}
//var_dump($_SESSION);
if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title> Admin | DoctoresEsp.</title>
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
                                                <!-- <p style="color:red;">
                                                    <php echo htmlentities($_SESSION['msg']); ?>
                                                    <php echo htmlentities($_SESSION['msg'] = ""); ?>
                                                </p> -->
                                                <form role="form" name="dcotorspcl" method="post" action="../../controllers/doctor-specilization.php">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Especialización de doctores</label>
                                                        <input type="text" name="especialidad" class="form-control" placeholder="Especialidades">
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-o btn-primary">Agregar</button>
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
