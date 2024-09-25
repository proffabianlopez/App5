<?php
require_once '../models/connection.php';
$conexion = conectar();
if($conexion){
    // Consulta SQL para obtener los barrios
    $sql = "SELECT id, name FROM neighborhood";

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    // Obtener todos los resultados
    $barrios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Consulta SQL para obtener los tipos de casas
    $sql2 = "SELECT id, type FROM address_type";

    // Preparar y ejecutar la consulta
    $stmt2 = $conexion->prepare($sql2);
    $stmt2->execute();
    
    // Obtener todos los resultados
    $casas = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Consulta SQL para obtener los tipos de casas
    $sql3 = "SELECT id, type FROM contact_type";

    // Preparar y ejecutar la consulta
    $stmt3 = $conexion->prepare($sql3);
    $stmt3->execute();
        
    // Obtener todos los resultados
    $contactos = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    cerrarConexion($conexion);
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Merlo | Register</title>

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="../../assets/css/animate.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">M+</h1>

            </div>
            <h3>Registrese en M+</h3>
            <p>Cree una cuenta para usar la plataforma.</p>
            <form class="m-t" role="form" action="../controllers/register.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nombre" required name="name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Apellido" required name="surname">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="DNI" required name="dni">
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" required name="birth_date">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                </div>
                
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Acepto los terminos y condiciones </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Registrarme</button>

                <p class="text-muted text-center"><small>¿Ya tiene una cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.html">Login</a>
            </form>
            <p class="m-t"> <small>App5 derechos reservados &copy; 2024</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

<?php
/* Datos extra en el login que luego el usuario deberá agregar para pedir un turno
<div class="form-group">
                    <select name="id_address_type" id="address" required>
                        <option value="">--Seleccione su vivienda-</option>
                            <?php foreach ($casas as $casa): ?>
                        <option value="<?= htmlspecialchars($casa['id']); ?>">
                            <?=htmlspecialchars($casa['type']); ?>
                        </option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="calle" name="street">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="número" name="number">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="departamento" name="apartment">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="piso" name="floor">
                </div>
                <div class="form-group">
                    <select name="id_contact_type" id="contact" required>
                        <option value="">--Seleccione su tipo de contacto-</option>
                            <?php foreach ($contactos as $contacto): ?>
                        <option value="<?= htmlspecialchars($contacto['id']); ?>">
                            <?=htmlspecialchars($contacto['type']); ?>
                        </option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="email@email.com or 1122334455" required name="contact">
                </div>
                <div class="form-group">
                    <select name="id_neighborhood" id="barrio" required>
                        <option value="">--Seleccione un barrio--</option>
                            <?php foreach ($barrios as $barrio): ?>
                        <option value="<?= htmlspecialchars($barrio['id']); ?>">
                            <?=htmlspecialchars($barrio['name']); ?>
                        </option>
                            <?php endforeach; ?>
                    </select>
                </div>
*/
?>