<?php
/*el usuario app5 no tiene los permisos para ejecutar querys, revisarlo ya que el usuario root no debe estar en el codigo, ademas no hardcodear las credenciales*/
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

/*$conexion = conectar(); // Almacenamos el objeto PDO en $conexion

if ($conexion) {
    echo '<pre>'; print_r($conexion); echo '</pre>'; 

    // Consulta mejorada
    $query = 'SELECT * FROM user';

    $stmt = $conexion->prepare($query);

    if ($stmt->execute()) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtén todas las filas de resultado
        var_dump($result);  // Muestra el resultado
    } else {
        // Si la ejecución falla, muestra el error
        print_r($stmt->errorInfo());
    }

    $stmt = null; // Cierra la conexión
} else {
    echo "Error al conectar a la base de datos.";
}*/
// Función para cerrar la conexión a la base de datos
function cerrarConexion($conexion) {
    // Cerrar la conexión
    $conexion = null;
    echo "Conexión cerrada";
}



// Función para abrir la conexión a la base de datos
/*function abrirConexion() {
    // Configurar los detalles de la conexión
    $host = getenv('DB_HOST');
    $usuario = getenv('DB_USER');
    $contrasena = getenv('DB_PASSWORD');
    $baseDatos = getenv('DB_NAME');

    try {
        // Crear una nueva instancia de PDO para conectarse a la base de datos
        $conexion = new PDO("mysql:host=.$host.;dbname=.$baseDatos.", $usuario, $contrasena);
        
        // Configurar el modo de error de PDO para lanzar excepciones en caso de errores
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Imprimir mensaje de éxito si la conexión se establece correctamente
        echo "Conexión exitosa a la base de datos MySQL";
        
        $conexion->exec("set names utf8");

        var_dump($conexion);

        // Retornar la conexión
        return $conexion;$_ENV["MYSQL_PASSWORD"]
    } catch(PDOException $e) {
        // Imprimir mensaje de error si la conexión falla
        echo "Error al conectar a la base de datos MySQL: " . $e->getMessage();
        return null;
    }
}*/

/*

// Abrir la conexión a la base de datos
$conexion = cerrarConexion();
var_dump($conexion);
//cerrarConexion($conexion);

$resultados = obtenerUsuarioPorEmailYPass($email, $password);
var_dump($resultados);
// Verificar si la conexión fue exitosa
function ObtenerUsuarioPorEmailYPass($email, $password)
    {if ($conexion) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
        
        // Preparar la sentencia
        $getData = $conexion->prepare($query);
        
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
    }
}

$email="angelezequielgomez19@gmail.com";
$password = "12345";

$resultados = obtenerUsuarioPorEmailYPass($email, $password);
var_dump($resultados);*/
?>
