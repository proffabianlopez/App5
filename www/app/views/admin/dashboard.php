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
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Administrar Usuarios</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-users.php">lista de usuarios
                                                <!-- <php
                                                $result = mysqli_query($con, "SELECT * FROM users");
                                                $num_rows = mysqli_num_rows($result);
                                                {
                                                ?>
                                                    Total Usuarios: <php echo htmlentities($num_rows); }
                                                ?> -->
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
                                        <h2 class="StepTitle">Administrar Doctores</h2>
                                        <p class="cl-effect-1">
                                            <a href="manage-doctors.php">
                                                <!-- <php
                                                $result1 = mysqli_query($con, "SELECT * FROM doctors");
                                                $num_rows1 = mysqli_num_rows($result1);
                                                {
                                                ?>
                                                    Total Doctors: <php echo htmlentities($num_rows1); }
                                                ?> -->
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
                                            <i class="fa fa-terminal fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Turnos</h2>
                                        <p class="links cl-effect-1">
                                            <a href="book-appointment.php">
                                                <a href="appointment-history.php">
                                                    <!-- <php
                                                    $sql = mysqli_query($con, "SELECT * FROM appointment");
                                                    $num_rows2 = mysqli_num_rows($sql);
                                                    {
                                                    ?>
                                                        Total Appointments: <php echo htmlentities($num_rows2); }
                                                    ?> -->
                                                </a>
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
                                            <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Administrar Pacientes</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-patient.php">
                                                <!-- <php
                                                $result = mysqli_query($con, "SELECT * FROM tblpatient");
                                                $num_rows = mysqli_num_rows($result);
                                                {
                                                ?>
                                                    Total Patients: <php echo htmlentities($num_rows); }
                                                ?> -->
                                            </a>
                                        </p>
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
    </div>
</body>
</html>
