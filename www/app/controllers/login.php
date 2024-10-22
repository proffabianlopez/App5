<?php
session_start();
require_once __DIR__ . '/../models/getUsers.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") { 
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST['password'] : null;
    $resultados = obtenerUsuarioPorEmail($email);

    if (!empty($resultados)) {
        foreach ($resultados as $usuario) {
            $email_sql = $usuario['email'];
            $pass_sql = $usuario['password'];
            $_SESSION['user'] = $usuario['id'];
            $_SESSION['rol'] = $usuario['id_rol'];
            $_SESSION['person'] = $usuario['id_person'];
            $_SESSION['email'] = $usuario['email'];

            if($email == $email_sql && password_verify($password, $pass_sql)){
                $response = ['status' => 'success'];

                if($_SESSION['rol'] == 1){
                    // Redirigir al dashboard de paciente
                    $response['redirect_url'] = "../views/patient/dashboard.php";
                }
                elseif ($_SESSION['rol'] == 2) {
                    // Redirigir al dashboard de admin
                    $response['redirect_url'] = "../views/admin/dashboard.php";
                }
                echo json_encode($response);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
                exit();
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Credenciales incorrectas']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'El método POST no está funcionando, hable con el administrador']);
    exit();
}

