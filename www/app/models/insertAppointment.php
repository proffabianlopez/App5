<?php
require_once 'connection.php';

function insertAppointment($date, $time, $id_doctor, $id_user,  $id_healthInsaurance){
    $connection = conectar();
    if($connection){
        try {
            $connection->beginTransaction();
            
            $query = "INSERT INTO appointment (date, time, id_specialist, id_user, id_health_insurance)
                      VALUES (:date, :time, :id_specialist, :id_user, :id_health_insurance)";
            
            $stmt = $connection->prepare($query);
            
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':id_specialist', $id_doctor, PDO::PARAM_INT);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_health_insurance', $id_healthInsaurance, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $connection->commit();
                cerrarConexion($connection);
                return true;
            } else {
                $connection->rollBack();
                cerrarConexion($connection);
                return false; 
            }
        } catch (PDOException $e) {
            $connection->rollBack();
            cerrarConexion($connection);
            //echo "Error en la consulta: " . $e->getMessage();
            return false; 
        }
    }
    return false;
}
