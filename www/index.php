

<?php

function probarConexion($host, $usuario, $contrasena, $baseDatos) {
    try {
        // Crear una nueva instancia de PDO para conectarse a la base de datos
        $conexion = new PDO("mysql:host=$host;dbname=$baseDatos", $usuario, $contrasena);
        
        // Configurar el modo de error de PDO para lanzar excepciones en caso de errores
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Imprimir mensaje de éxito si la conexión se establece correctamente
        echo "Conexión exitosa a la base de datos MySQL.";
        
        // Cerrar la conexión
        $conexion = null;

        return true;
    } catch(PDOException $e) {
        // Imprimir mensaje de error si la conexión falla
        echo "Error al conectar a la base de datos MySQL: " . $e->getMessage();
        return false;
    }
}


// Configurar los detalles de la conexión

$host = getenv('DB_HOST');
$usuario = getenv('DB_USER');
$contrasena = getenv('DB_PASSWORD');
$baseDatos = getenv('DB_NAME');

// var_dump ($host);
// var_dump ($usuario);
// var_dump ($contrasena);
// var_dump ($baseDatos);

// Llamar a la función para probar la conexión
$conexionExitosa = probarConexion($host, $usuario, $contrasena, $baseDatos);

// Puedes usar la variable $conexionExitosa para tomar decisiones basadas en si la conexión fue exitosa o no
if ($conexionExitosa) {
    // Realizar más acciones, como ejecutar consultas, etc.
    echo "EXITO";
} else {
    // Manejar el caso en el que la conexión no fue exitosa
    echo "La conexión a la base de datos falló.";
}
?>

