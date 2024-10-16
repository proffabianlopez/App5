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
// else{
//     session_start();
// }
//var_dump($_SESSION);
//$_SESSION['user'];
//$_SESSION['rol'];
//include('include/config.php');
//include('include/checklogin.php');
//check_login();
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
    <title>Admin | Vista general</title>
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
                                <h1 class="mainTitle">Administración | Vista general</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Vista general</span></li>
                            </ol>
                        </div>
                    </section>
                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Administrar Doctores</h2>
                                        <p class="cl-effect-1">
                                            <a href="doctorsList.php">
                                                Lista de doctores
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Administrar paciente</h2>
                                        <p class="cl-effect-1">
                                            <a href="manage-users.php">
                                                Lista de usuarios
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Turnos</h2>
                                        <p class="links cl-effect-1">
                                            <a href="book-appointment.php"></a>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <?php include('../include/footer.php'); ?>
                <?php include('../include/setting.php'); ?>
            </div>
        </div>
		<?php include('../include/script.php'); ?>
    </div>
</body>
</html>
