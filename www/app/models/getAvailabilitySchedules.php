<?php
// session_start();
/*if (isset( $_SESSION)) {
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
}*/

require_once 'connection.php';

function obtenerHorariosyDias($specialistId) {
    $conecction = conectar();
    if ($conecction) {
        // Preparar la consulta SQL con JOINs para obtener los datos relacionados
        $query = "
            SELECT 
                sd.id AS dia_servicio, 
                sh.start_time AS hora_inicio, 
                sh.end_time AS hora_fin,
                ad.appointment_duration AS duracion_turno
            FROM availability_schedules AS av
            INNER JOIN service_day AS sd ON av.id_service_day = sd.id
            INNER JOIN service_hours AS sh ON av.id_service_hours = sh.id
            INNER JOIN appointment_duration AS ad ON av.id_appointment_duration = ad.id
            WHERE av.id_specialist = :specialistId
        ";
        
        // Preparar la sentencia
        $stmt = $conecction->prepare($query);
        
        // Vincular el parámetro del ID del especialista
        $stmt->bindParam(':specialistId', $specialistId, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener los resultados como un array asociativo
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar la conexión
        cerrarConexion($conecction);
        
        // Definir los días de la semana
        $dias_semana = [
            1 => "Lunes",
            2 => "Martes",
            3 => "Miércoles",
            4 => "Jueves",
            5 => "Viernes",
            6 => "Sábado",
            7 => "Domingo"
        ];
        
        // Mapeo de los IDs de los días al nombre del día
        foreach ($resultados as &$resultado) {
            $dia_id = $resultado['dia_servicio'];
            if (isset($dias_semana[$dia_id])) {
                $resultado['dia_servicio_nombre'] = $dias_semana[$dia_id];
            } else {
                $resultado['dia_servicio_nombre'] = "Día desconocido"; // Por si algún día no está mapeado
            }
        }

        // Retornar los resultados con el nombre del día añadido
        return $resultados;
    } else {
        echo "No se pudo establecer la conexión a la base de datos.<br>";
        return null;
    }
}