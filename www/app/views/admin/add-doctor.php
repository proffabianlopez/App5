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
                        <?php
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
                        <?php
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
</html>
