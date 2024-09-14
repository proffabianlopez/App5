<?php
require_once '../models/usersAndPassword.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST['password'] : null;
} else {
    echo "Método de solicitud no válido. Utilice el método POST.";
}


$resultados = ObtenerUsuarioPorEmailYPass($email);

// Mostrar los resultados
if (!empty($resultados)) {
    foreach ($resultados as $usuario) {
        $email_sql= $usuario['email'];
        $pass_sql= $usuario['password'];
        $_SESSION['user'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['id_rol'];
        // logica de ingreso
        if($email == $email_sql && password_verify($password, $pass_sql)){
            //echo("Login exitoso, redirigir al dashboard paciente");
            if($_SESSION['rol'] == 1){
                header('Location:index.php');
            }
            elseif ($_SESSION['rol'] == 2) {
                header("Location:dashboard.php");
            }
        }
    }
} else {
    echo "No se encontraron usuarios con ese email y password.<br>";
}