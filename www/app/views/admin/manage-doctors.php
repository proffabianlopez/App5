<?php
include '../../controllers/login.php'; // para usar la sesion
include '../../models/getSpecialist.php'; // tengo al doctor, con su licencia y la especialidad

if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}

$doctores = obtenerEspecialistasYLicencias();
//var_dump($doctores);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de doctores</title>
</head>
<body>
    <form action="../../controllers/manage-doctors.php" method="post">
        <select name="id_doctor" required>
            <option value="">Seleccione un doctor</option>
            <?php
                if (!empty($doctores)) {
                    foreach ($doctores as $doctor) {
                        echo '<option value="' . htmlspecialchars($doctor['id']) . '">' . htmlspecialchars($doctor['name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No hay doctores disponibles</option>';
                }
            ?>
        </select>
        <br>
        <label for="text">Ingrese la duracion del turno (minutos)</label>
        <input type="number" name="duracion_del_turno" required>
        <br>
        <?php /*codigo php para elegir los dias disponibles*/ ?>
        <label for="text">Seleccione los dias laborables</label>
        <input type="checkbox" name="id_dia[]" value="1">
        <label for="">Lunes</label>
        <input type="checkbox" name="id_dia[]" value="2">
        <label for="">Martes</label>
        <input type="checkbox" name="id_dia[]" value="3">
        <label for="">Miercoles</label>
        <input type="checkbox" name="id_dia[]" value="4">
        <label for="">Jueves</label>
        <input type="checkbox" name="id_dia[]" value="5">
        <label for="">Viernes</label>
        <input type="checkbox" name="id_dia[]" value="6">
        <label for="">Sabado</label>
        <input type="checkbox" name="id_dia[]" value="7">
        <label for="">Domingo</label>
        <br>
        <label for="text">Ingrese la franja horaria de trabajo</label>
        <input type="time" name="desde" required>
        <input type="time" name="hasta" required>
        <br>
        <button type="submit">Cargar Disponibilidad</button>
    </form>
</body>
</html>