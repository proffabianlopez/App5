<?php
session_start();
require_once '../models/connection.php';
//validar
// $especialidad = empty($_POST['especialidad']
if (isset( $_SESSION)) {
    if (( $_SESSION['rol']) == "" or  $_SESSION['rol'] != '2') {
        // var_dump($_SESSION['rol']);
        // exit;
        // ob_start();
        
            echo '<script type="text/javascript">';
            echo 'window.location.href="../login.php";';
            echo '</script>';
            exit();
    } 
    // else {
    //     $useremail = $_SESSION["email"];
    // }
} else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="../login.php";';
        echo '</script>';
        exit();
}
if(empty($especialidad = $_POST['especialidad'])){
    //validacion o redireccion
    echo '<script type="text/javascript">';
    echo 'alert("Ingrese una especialidad");';
    echo 'window.location.href="../views/admin/doctor-specilization.php";';
    echo '</script>';
    exit();
}
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
        // echo "<script>alert('Carga exitosa');</>";
        cerrarConexion($conecction);
        echo '<script type="text/javascript">';
        echo 'window.location.href="../views/admin/doctor-specilization.php?status=success"';
        echo '</script>';
        exit();
        // header("Location: /app/views/admin/doctor-specilization.php");
        // exit();
    }
    catch(Exception $e) {
        $conecction->rollBack();
        echo "Error al insertar datos: " . $e->getMessage();
    }
}

?>

