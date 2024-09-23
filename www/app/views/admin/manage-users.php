<?php
include '../../models/connection.php';
include '../../controllers/login.php';
if(!isset($_SESSION)){
    echo "redireccionando";
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}
var_dump($_SESSION);
if(empty($_SESSION)){
    echo '<script type="text/javascript">';
    echo 'window.location.href="../login.php";';
    echo '</script>';
    exit();
}
function ObtenerUsuarios(){
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM user";
            
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
            
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

$resultados = ObtenerUsuarios();
var_dump($resultados);
?>