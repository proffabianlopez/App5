<?php
require_once 'connection.php';

$conecction = abrirConexion();

function ObtenerUsuarioPorEmailYPass($email, $password){
     // Preparar la consulta SQL
     $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        
     // Preparar la sentencia
     $getData = $conecction->prepare($query);
     
     // Asignar valores a los parámetros
     $getData->bindParam(':email', $email);
     $getData->bindParam(':password', $password);
     
     // Ejecutar la consulta
     $getData->execute();
     
     // Obtener los resultados como un array asociativo
     $resultados = $getData->fetchAll(PDO::FETCH_ASSOC);
     
     // Cerrar la conexión
     cerrarConexion($conexion);
     
     // Retornar los resultados
     return $resultados;
    
    /*if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        
        // Preparar la sentencia
        $getData = $conecction->prepare($query);
        
        // Asignar valores a los parámetros
        $getData->bindParam(':email', $email);
        $getData->bindParam(':password', $password);
        
        // Ejecutar la consulta
        $getData->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $getData->fetchAll(PDO::FETCH_ASSOC);
        
        // Cerrar la conexión
        cerrarConexion($conexion);
        
        // Retornar los resultados
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }*/
}


$email="angelezequielgomez19@gmail.com";
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
}