<?php
session_start();
require_once __DIR__ . '/../models/getUsers.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST['password'] : null;
    $resultados = obtenerUsuarioPorEmail($email);
    //var_dump($resultados);
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
                    header('Location:../views/patient/dashboard.php');
                    exit();
            }
            elseif ($_SESSION['rol'] == 2) {
                header("Location:../views/admin/dashboard.php");
                exit();
            }
        }
        //session_unset();
    }
    } else {
        //logica para un msj con ajax para informar que las credenciales son incorrectas
}
} else {
    //logica para un msj con ajax de que el metodo POST no funciona
}


