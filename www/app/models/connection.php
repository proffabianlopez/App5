<?php
function conectar() {
    $host=getenv("DB_HOST");
    $dbname=getenv("DB_NAME");
    $usuario=getenv("DB_USER");
    $password=getenv("DB_PASSWORD");
    // PDO("mysql:host=nombre_del_servidor; dbname=nombre_de_DB", "usuario", "contraseña");
    $link = new PDO("mysql:host=".$host."; dbname=$dbname", "$usuario","$password");
    $link->exec("set names utf8");
    return $link;
}

// Función para cerrar la conexión a la base de datos
function cerrarConexion($conexion) {
    // Cerrar la conexión
    $conexion = null;
    //echo "Conexión cerrada";
}


?>
