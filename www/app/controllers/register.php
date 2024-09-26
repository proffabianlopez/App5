<?php
require_once '../models/connection.php';
//var_dump($_POST);
$name = $_POST['name'];
$surname = $_POST['surname'];
$dni = $_POST['dni'];
$birth_date = $_POST['birth_date'];
$emil = $_POST['email'];
$password = $_POST['password'];
//$street = $_POST['street'];
//$number = $_POST['number'];
//$apartment = $_POST['apartment'];
//$floor = $_POST['floor'];
//$id_neighborhood = $_POST['id_neighborhood'];


//echo($name." ".$surname." ".$dni." ".$birth_date." ".$emil." ".$password." ".$street." ".$number." ".$apartment." ".$floor." ".$id_neighborhood);


try {
    $conexion=conectar();
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
        ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT)  // Asegúrate de encriptar las contraseñas
    ]);
/*
    // Insertar en la tabla 'address' usando el ID de 'person'
    $sql_address = "INSERT INTO address (id_person, id_address_type, street, number, apartment, floor, id_neighborhood) VALUES (:id_person, :id_address_type, :street, :number, :apartment, :floor, :id_neighborhood)";
    $stmt_address = $conexion->prepare($sql_address);
    $stmt_address->execute([
        ':id_person' => $id_person,
        'id_address_type' => $_POST['id_address_type'],
        ':street' => $_POST['street'],
        ':number' => $_POST['number'],
        ':apartment' => $_POST['apartment'],
        ':floor' => $_POST['floor'],
        ':id_neighborhood' => $_POST['id_neighborhood']
    ]);

    // Insertar en la tabla 'contact' usando el ID de 'person'
    $sql_contact = "INSERT INTO contact (id_person, id_contact_type, contact, status) VALUES (:id_person, :id_contact_type, :contact, 1)";
    $stmt_contact = $conexion->prepare($sql_contact);
    $stmt_contact->execute([
        ':id_person' => $id_person,
        ':id_contact_type' => $_POST['id_contact_type'],
        ':contact' => $_POST['contact']
    ]);
*/
    cerrarConexion($conexion);
    // Confirmar (commit) la transacción
    $conexion->commit();
    //echo "Datos insertados correctamente";
    header('Location:../views/login.php');

} catch (Exception $e) {
    // Si ocurre un error, revertir (rollback) la transacción
    $conexion->rollBack();
    echo "Error al insertar datos: " . $e->getMessage();
}
?>