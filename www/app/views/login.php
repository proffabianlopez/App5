<?php
error_reporting(0);
if(!isset($_SESSION)){
    session_start();
}
else{
    session_unset();
}
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clinica | Login</title>

    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../../assets/css/animate.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">M+</h1>

            </div>
            <h3>Bienvenido a la Clinica</h3>
            <p>
                Brindando servicios de salud desde XXXX a la comunidad
            </p>
            <p>Inicie Sesión para tener acceso a la plataforma.</p>
            <div id = "messaje"></div>
            <form id = "loginForm" class="m-t" role="form" method="POST" action="../controllers/login.php">
                <div class="form-group">
                    <input id = "email" type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <input id = "pass" type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                </div>
                <button id = "submitButton" type="submit" class="btn btn-primary block full-width m-b"><a href="dashboard.php"></a>Login</button>

                <a href="#"><small>¿Olvidó su contraseña?</small></a>
                <p class="text-muted text-center"><small>¿No tiene una cuenta?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.php">Cree una cuenta</a>
            </form>
            <p class="m-t"> <small>App5 derechos reservados &copy; 2024</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../../assets/js/jquery-3.1.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/login.js"></script>

</body>

</html>
