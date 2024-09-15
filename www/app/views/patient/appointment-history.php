<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Usuario | Historial de Turno</title>
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
                                    <h1 class="mainTitle">Usuario | Historial de Turno</h1>
                                </div>
                                <ol class="breadcrumb">
                                    <li><span>Usuario </span></li>
                                    <li class="active"><span>Historial de Turno</span></li>
                                </ol>
                            </div>
                        </section>

                        <div class="container-fluid container-fullw bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover" id="sample-table-1">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th class="hidden-xs">Nombre del Doctor</th>
                                            <th>Especialización</th>
                                            <th>Obra Social- Particular</th>
                                            <th>Fecha / Hora de la Cita</th>
                                            <th>Fecha de Creación de la Cita</th>
                                            <th>Estado Actual</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            <tr>
                                                <td class="center">1.</td>
                                                <td class="hidden-xs">Dr. Smith</td>
                                                <td>Cardiología</td>
                                                <td></td>
                                                <td>2024-09-10 / 10:00 AM</td>
                                                <td>2024-09-01</td>
                                                <td>Active</td>
                                                <td>
                                                    <a href="#" onClick="return confirm('Are you sure you want to cancel this appointment?')" class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment">Cancel</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="center">2.</td>
                                                <td class="hidden-xs">Dr. Johnson</td>
                                                <td>Dermatología</td>
                                                <td></td>
                                                <td>2024-09-12 / 3:00 PM</td>
                                                <td>2024-09-03</td>
                                                <td>Cancelled</td>
                                                <td>Cancelled</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
