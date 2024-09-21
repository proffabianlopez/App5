<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Usuario | Reservar Turno</title>
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
                                    <h1 class="mainTitle">Usuario | Reservar Turno</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Usuario</span></li>
                                    <li class="active"><span>Reservar Turno</span></li>
                                </ol>
                        </section>
                        
                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row margin-top-30">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Reservar Turno</h5>
                                                </div>
                                                <div class="panel-body">
                                                    <form role="form" name="book" method="post">
                                                        <div class="form-group">
                                                            <label for="DoctorSpecialization">Especialización Médico</label>
                                                            <select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
                                                                <option value="">Selecionar Especialización</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="doctor">Médico</label>
                                                            <select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
                                                                <option value="">Seleccionar Médico</option>
                                                            </select>
                                                        </div>

                                                        <!-- OBRASOCIAL -->
                                                        <!-- <div class="form-group">
                                                            <label for="consultancyfees">Consultancy Fees</label>
                                                            <select name="fees" class="form-control" id="fees" readonly></select>
                                                        </div> -->

                                                        <div class="form-group">
                                                            <label for="AppointmentDate">fecha</label>
                                                            <input class="form-control datepicker" name="appdate" required="required" data-date-format="yyyy-mm-dd">
                                                        </div>

                                                        <?php
                                                        //AJAX para mostrar los horarios disponibles
                                                        ?>

                                                        <div class="form-group">
                                                            <label for="Appointmenttime">hora</label>
                                                            <input class="form-control" name="apptime" id="timepicker1" required="required">
                                                            <small>ej : 10:00 PM</small>
                                                        </div>														
                
                                                        <button type="submit" name="submit" class="btn btn-o btn-primary">Enviar</button>
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

        <script src="/assets/vendor/jquery/jquery.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/vendor/modernizr/modernizr.js"></script>
        <script src="/assets/vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="/assets/vendor/switchery/switchery.min.js"></script>
        <script src="/assets/vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="/assets/vendor/autosize/autosize.min.js"></script>
        <script src="/assets/vendor/selectFx/classie.js"></script>
        <script src="/assets/vendor/selectFx/selectFx.js"></script>
        <script src="/assets/vendor/select2/select2.min.js"></script>
        <script src="/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="/assets/vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/form-elements.js"></script>

        <script>
            jQuery(document).ready(function() {
                Main.init();
                FormElements.init();
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                startDate: '-3d'
            });

            $('#timepicker1').timepicker();
        </script>
    </body>
</html>
<?php
//ajax para
?>