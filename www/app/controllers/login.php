<?php
require_once '../models/usersAndPassword.php';
session_start();
//$email = $_POST["email"];
//$password = $_POST["password"];
if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
} else {
    echo "Método de solicitud no válido. Utilice el método POST.";
}


$resultados = ObtenerUsuarioPorEmailYPass($email, $password);

// Mostrar los resultados
if (!empty($resultados)) {
    foreach ($resultados as $usuario) {
        $email_sql= $usuario['email'];
        $pass_sql= $usuario['password'];
        $_SESSION['user'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['id_rol'];
        //echo($email_sql);
        //echo($pass_sql);
        //echo "Password: " . $usuario['password'] . "<br>";
        //echo "Email: " . $usuario['email'] . "<br>";
        // logica de ingreso
        if($email == $email_sql and $password == $pass_sql){
            echo("Login exitoso, redirigir al dashboard");
            header('Location:index.php');
        }
    }
} else {
    echo "No se encontraron usuarios con ese email y password.<br>";
}