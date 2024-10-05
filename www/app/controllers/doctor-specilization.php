<?php
require_once '../models/connection.php'; // necesito la clase
// conexion para conectarme a la base y enviar los datos a la misma

$especialidad = $_POST['especialidad']; 
//echo $especialidad;

$conecction = conectar();

if($conecction)
{
    try{
        $conecction->beginTransaction();
        $query = "INSERT INTO specialisties (speciality) VALUES (:speciality)";
        $stmt = $conecction->prepare($query);
        $stmt -> execute([':speciality' => $especialidad]);
            // Confirmar (commit) la transacción
        $conecction->commit();
        echo "Datos insertados correctamente";
        cerrarConexion($conecction);
    }
    catch(Exception $e) {
        $conecction->rollBack();
        echo "Error al insertar datos: " . $e->getMessage();
    }
}

?>

