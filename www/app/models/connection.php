<?php

// Función para abrir la conexión a la base de datos
function abrirConexion() {
    // Configurar los detalles de la conexión
    $host = getenv('DB_HOST');
    $usuario = getenv('DB_USER');
    $contrasena = getenv('DB_PASSWORD');
    $baseDatos = getenv('DB_NAME');

    try {
        // Crear una nueva instancia de PDO para conectarse a la base de datos
        $conexion = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $contrasena);
        
        // Configurar el modo de error de PDO para lanzar excepciones en caso de errores
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Imprimir mensaje de éxito si la conexión se establece correctamente
        echo "Conexión exitosa a la base de datos MySQL.<br>";
        
        // Retornar la conexión
        return $conexion;
    } catch(PDOException $e) {
        // Imprimir mensaje de error si la conexión falla
        echo "Error al conectar a la base de datos MySQL: " . $e->getMessage();
        return null;
    }
}

// Función para cerrar la conexión a la base de datos
function cerrarConexion($conexion) {
    // Cerrar la conexión
    $conexion = null;
    echo "Conexión cerrada";
}

// Abrir la conexión a la base de datos
//$conexion = abrirConexion();
//cerrarConexion($conexion);


// Verificar si la conexión fue exitosa
/*if ($conexion) {
    // Aquí puedes realizar operaciones con la base de datos usando $conexion
    // Ejemplo: $conexion->query('SELECT * FROM tabla');
    
    // Cerrar la conexión después de terminar las operaciones
    cerrarConexion($conexion);
} else {
    echo "No se pudo establecer la conexión a la base de datos.<br>";
}*/

?>
