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
                <div class="form-group" placeholder="Pediatria" required>
                    <?php /*traer mediante un select las distintas especialidades*/ ?>
                </div>
                <div class="form-group" placeholder="Matricula XXXX" required>
                <?php /*traer mediante un select las distintas matriculas*/ ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="MN XXXXXX" required name="license">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Cargar</button>
            </form>
            <p class="m-t"> <small>App5 derechos reservados &copy; 2024</small> </p>
        </div>
    </div>
</body>
</html>
