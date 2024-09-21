<?php
require_once '../models/connection.php'; // Asegúrate de incluir la conexión a la BD
try {
    $pdo = conectar();

    $email_admin=getenv("ADMIN_EMAIL");
    $password_admin=getenv("ADMIN_PASS"); // Contraseña en texto plano

    // Hashear la contraseña antes de insertar
    $hashed_password = password_hash($password_admin, PASSWORD_BCRYPT);

    // Intentar insertar el administrador
    $sql_insert_admin = "INSERT INTO user (id_person, id_rol, email, password, status) VALUES (:id_person, :id_rol, :email, :password, :status)";
    $stmt = $pdo->prepare($sql_insert_admin);
    $stmt->execute([
        ':id_person' => 1, // Tiene que haber una persona pre-cargada para el admin
        ':id_rol' => 2, // Rol de administrador
        ':email' => $email_admin,
        ':password' => $hashed_password,
        ':status' => 1 // activarlo desde su creacion
    ]);

    echo "Administrador pre-cargado exitosamente.";
} catch (PDOException $e) {
    // Si el error es por clave única, mostrar un mensaje amigable
    if ($e->getCode() == 23000) { // Código de error SQL para violación de restricción de clave única
        echo "El administrador con el correo $email_admin ya está registrado.";
    } else {
        // Si es otro tipo de error, mostrar el mensaje de error genérico
        echo "Error al cargar administrador: " . $e->getMessage();
    }
}
