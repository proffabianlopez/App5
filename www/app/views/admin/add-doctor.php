<?php
error_reporting(0);
include '../../controllers/login.php';
include '../../models/getSpecialities.php';
require_once '../../models/getLicenseType.php';
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

$license_types = obtenerTiposDeLicencias();
$specialities = obtenerEspecialidades();
?>
<!-- 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Especialistas</title>
</head>
<body>
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">M+</h1>

            </div>
            <h3>Agregue un doctor en M+</h3>
            <form class="m-t" role="form" action="../../controllers/add-doctor.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre" required name="name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Apellido" required name="surname">
                </div>
                <div class="form-group">
                    <label for="text">Realza consulta online?</label>
                    <select name="onlineConsultation">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Calle" required name="street">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="1234" required name="number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="departamento" name="apartment">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="piso" name="floor">
                </div>
                <div class="form-group" required>
                    <select name="speciality" class="form-control">
                        <option value="">Seleccione un tipo de especialidad</option>
                        <php
                        // Verificar si se obtuvieron resultados
                        if (!empty($specialities)) {
                        // Recorrer los tipos de licencia y generar las opciones
                            foreach ($specialities as $speciality) {
                                echo '<option value="' . htmlspecialchars($speciality['id']) . '">' . htmlspecialchars($speciality['speciality']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No hay tipos de especialidades disponibles</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" required>
                    <select name="license_type" class="form-control">
                        <option value="">Seleccione un tipo de matrícula</option>
                        <php
                        // Verificar si se obtuvieron resultados
                        if (!empty($license_types)) {
                        // Recorrer los tipos de licencia y generar las opciones
                            foreach ($license_types as $license) {
                                echo '<option value="' . htmlspecialchars($license['id']) . '">' . htmlspecialchars($license['type']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No hay tipos de matrícula disponibles</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="MN XXXXXX" required name="license_number">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Cargar Doctor</button>
            </form>
            <p class="m-t"><small>App5 derechos reservados &copy; 2024</small></p>
        </div>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin | Agregar Doctor</title>
    <?php include ('../include/head.php');?>

    <!-- <script type="text/javascript">
        function valid() {
            if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.adddoc.cfpass.focus();
                return false;
            }
            return true;
        }
    </script>

    <script>
        function checkemailAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#docemail").val(),
                type: "POST",
                success: function (data) {
                    $("#email-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {}
            });
        }
    </script> -->
</head>
<body>
    <div id="app">
    <?php include('../include/sidebar_admin.php'); ?>
    <div class="app-content">
    <?php include('../include/header.php'); ?>
            
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Agregar Doctor</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Agregar Doctor</span></li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->

                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Agregar Doctor</h5>
                                            </div>

                                            <div class="form-group">
                                            <label for="text">Realza consulta online?</label>
                                            <select name="onlineConsultation">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            </div>

                                            <div class="panel-body">
                                                <form role="form" name="adddoc" method="post" onSubmit="return valid();">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">Especialización</label>
                                                        <select name="Doctorspecialization" class="form-control" required="true">
                                                            <option value="">Seleccionar especialización</option>
                                                            <!-- <php 
                                                                $ret = mysqli_query($con, "select * from doctorspecilization");
                                                                while ($row = mysqli_fetch_array($ret)) { 
                                                            ?> -->
                                                            <!-- <option value="<php echo htmlentities($row['specilization']); ?>">
                                                                <php echo htmlentities($row['specilization']); ?> -->
                                                            </option>
                                                            <!-- <php } ?> -->
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctorname">Nombre</label>
                                                        <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctorname">Apellido</label>
                                                        <input type="text" name="docname" class="form-control" placeholder="Enter Doctor Name" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Calle</label>
                                                        <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">numero</label>
                                                        <textarea name="clinicaddress" class="form-control" placeholder="Enter Doctor Clinic Address" required="true"></textarea>
                                                    </div>                                                    
<!-- 
                                                    <div class="form-group">
                                                        <label for="fess">Doctor Consultancy Fees</label>
                                                        <input type="text" name="docfees" class="form-control" placeholder="Enter Doctor Consultancy Fees" required="true">
                                                    </div> -->

                                                    <!-- <div class="form-group">
                                                        <label for="fess">Doctor Contact no</label>
                                                        <input type="text" name="doccontact" class="form-control" placeholder="Enter Doctor Contact no" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fess">Doctor Email</label>
                                                        <input type="email" id="docemail" name="docemail" class="form-control" placeholder="Enter Doctor Email id" required="true" onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" name="npass" class="form-control" placeholder="New Password" required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword2">Confirm Password</label>
                                                        <input type="password" name="cfpass" class="form-control" placeholder="Confirm Password" required="required">
                                                    </div> -->

                                                    <button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">Submit</button>
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
                    <!-- end: BASIC EXAMPLE -->
                </div>
            </div>
        </div>
        
        <!-- start: FOOTER -->
        <?php include('include/footer.php'); ?>
        <!-- end: FOOTER -->

        <!-- start: SETTINGS -->
        <?php include('include/setting.php'); ?>
        <!-- end: SETTINGS -->
    </div>

    <!-- start: MAIN JAVASCRIPTS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <script src="vendor/jquery-cookie/jquery.cookie.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/switchery/switchery.min.js"></script>
    <!-- end: MAIN JAVASCRIPTS -->

    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
    <script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="vendor/autosize/autosize.min.js"></script>
    <script src="vendor/selectFx/classie.js"></script>
    <script src="vendor/selectFx/selectFx.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <!-- start: CLIP-TWO JAVASCRIPTS -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function() {
            Main.init();
            FormElements.init();
        });
    </script>
    <!-- end: CLIP-TWO JAVASCRIPTS -->
</body>
</html>

