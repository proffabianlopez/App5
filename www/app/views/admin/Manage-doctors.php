<?php
include '../../models/connection.php';
include '../../controllers/login.php'; // para usar la sesion

if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

$conexion = conectar();
if($conexion){
    $query = "SELECT * FROM specialist_license_specialty";
    $query= "SELECT * FROM specialisties"; 
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de doctores</title>
</head>
<body>
    <form action="../../controllers/Manage-doctors.php" method="post">
        <select name="id_especialidad" id="">
            <option>
                <?php echo "codigo php para generear una lista de options con los nombres de las especialidades y enviar su id" ?>
            </option>
        </select>
        <select name="id_doctor" id="">
            <option>
                <?php echo "codigo php para generear una lista de options con los nombres de los doctores y enviar su id" ?>
            </option>
        </select>
        <?php /*codigo php para elegir los dias disponibles*/ ?>
        <input type="checkbox" name="id_dia" value="id-del-dia">
        <label for="">Lunes</label>
        <input type="time" name="desde">
        <input type="time" name="hasta">
    </form>
</body>
</html>