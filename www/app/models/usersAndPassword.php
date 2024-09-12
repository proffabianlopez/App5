<?php
require_once 'connection.php';


function ObtenerUsuarioPorEmailYPass($email){
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM user WHERE email = :email";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Asignar valores a los parámetros
        $stmt->bindParam(':email', $email);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Cerrar la conexión
        cerrarConexion($conecction);
        
        // Retornar los resultados
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}


/*$email="angelezequielgomez19@gmail.com";
$password = "12345";

$resultados = obtenerUsuarioPorEmailYPass($email, $password);
var_dump($resultados);
// Mostrar los resultados
if(!empty($resultados)) {
    foreach ($resultados as $usuario) {
        $email_sql= $usuario['email'];
        $pass_sql= $usuario['password'];
        var_dump("ID: " . $usuario['id']);
        var_dump("Email: " . $usuario['email']);
        // Puedes mostrar más datos según sea necesario
    }
} else {
    echo "No se encontraron usuarios con ese email y password.<br>";
}*/