<?php
require_once '../models/usersAndPassword.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Asegurarse de que el método sea POST
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Obtener los datos del formulario
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Aquí va tu lógica de autenticación
        echo "Email: $email<br>";
        echo "Contraseña: $password<br>";

        // Lógica adicional para comparar datos con la base de datos...
    } else {
        echo "Los datos del formulario no se han enviado correctamente.";
    }
} else {
    echo "Método de solicitud no válido. Utilice el método POST.";
}
$resultados = obtenerUsuarioPorEmailYPassword($email, $password);

// Mostrar los resultados
if (!empty($resultados)) {
    foreach ($resultados as $usuario) {
        $email_sql= $usuario['email'];
        $pass_sql= $usuario['password'];
        echo "ID: " . $usuario['id'] . "<br>";
        echo "Email: " . $usuario['email'] . "<br>";
        // Puedes mostrar más datos según sea necesario
    }
} else {
    echo "No se encontraron usuarios con ese email y password.<br>";
}