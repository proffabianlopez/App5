<?php
require_once '../models/connection.php';
require_once '../models/getUsers.php';
require_once '../models/getPersonByDni.php';

// Mostrar errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

// Obtener los valores del POST
$name = $_POST['name'];
$surname = $_POST['surname'];
$dni = $_POST['dni'];
$birth_date = $_POST['birth_date'];
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar la edad del usuario (debe ser mayor de 18 años)
$birthDate = new DateTime($birth_date);  // Convertir la fecha de nacimiento en un objeto DateTime
$today = new DateTime();  // Obtener la fecha actual
$age = $today->diff($birthDate)->y;  // Calcular la diferencia de años entre las fechas

if ($age < 18) {
    echo json_encode(['status' => 'error', 'message' => 'Debe ser mayor de 18 años para registrarse.']);
    exit();
}

if ($age > 100) {
    echo json_encode(['status' => 'error', 'message' => 'Ingrese una edad menor a 100 años.']);
    exit();
}

// Verificar si el email ya está en uso
$user = obtenerUsuarioPorEmail($email);
if (!empty($user)) {
    echo json_encode(['status' => 'error', 'message' => 'Email no válido']);
    exit();
}

// Verificar si el DNI ya está en uso
$persona = obtenerPersonaPorDni($dni);
if (!empty($persona)) {
    echo json_encode(['status' => 'error', 'message' => 'DNI no válido']);
    exit();
}

try {
    $conexion = conectar();
    // Iniciar la transacción
    $conexion->beginTransaction();

    // Insertar en la tabla 'person'
    $sql_person = "INSERT INTO person (name, surname, dni, birth_date) VALUES (:name, :surname, :dni, :birth_date)";
    $stmt_person = $conexion->prepare($sql_person);
    $stmt_person->execute([
        ':name' => $_POST['name'],
        ':surname' => $_POST['surname'],
        ':dni' => $_POST['dni'],
        ':birth_date' => $_POST['birth_date']
    ]);

    // Obtener el ID del último registro insertado
    $id_person = $conexion->lastInsertId();

    // Insertar en la tabla 'user' usando el ID de 'person'
    $sql_user = "INSERT INTO user (id_person, id_rol, email, password) VALUES (:id_person, 1, :email, :password)";
    $stmt_user = $conexion->prepare($sql_user);
    $stmt_user->execute([
        ':id_person' => $id_person,
        ':email' => $_POST['email'],
        ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
    ]);

    // Confirmar (commit) la transacción
    $conexion->commit();
    cerrarConexion($conexion);

    // Respuesta exitosa con URL de redirección
    echo json_encode(['status' => 'success', 'redirect_url' => '../views/login.php']);

} catch (Exception $e) {
    // Si ocurre un error, revertir (rollback) la transacción
    $conexion->rollBack();
    echo json_encode(['status' => 'error', 'message' => 'Error al insertar datos: ' . $e->getMessage()]);
}
?>
