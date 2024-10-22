<?php
require_once 'connection.php';

function UpdateSpecialist($id_doctor, $name, $surname, $onlineConsultation, $street, $number, $apartment, $floor) {
    $connection = conectar();
    if($connection){
        try {
            // Iniciamos la transacción
            $connection->beginTransaction();
            
            // Preparamos la consulta SQL para actualizar en la tabla 'specialist'
            $query = "UPDATE specialist 
                      SET name = :name, 
                          surname = :surname, 
                          street = :street, 
                          number = :number, 
                          apartment = :apartment, 
                          floor = :floor, 
                          online_consultation = :online_consultation 
                      WHERE id = :id_doctor";
            
            $stmt = $connection->prepare($query);
            
            // Vincular los parámetros a las variables de PHP
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindParam(':street', $street, PDO::PARAM_STR);
            $stmt->bindParam(':number', $number, PDO::PARAM_INT);
            if ($apartment !== "null") {
                $stmt->bindParam(':apartment', $apartment, PDO::PARAM_STR);
            } else {
                $stmt->bindValue(':apartment', $apartment, PDO::PARAM_NULL);
            }
            if($floor !== "null"){
                $stmt->bindParam(':floor', $floor, PDO::PARAM_STR);
            } else{
                $stmt->bindParam(':floor', $floor, PDO::PARAM_NULL); 
            }
            $stmt->bindParam(':online_consultation', $onlineConsultation, PDO::PARAM_INT);
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);

            if ($stmt->execute()) {
                //$connection->commit();
                //echo "Datos actualizados correctamente del Doctor.";
                if ($stmt->rowCount() > 0) {
                    // Si se actualizó alguna fila
                    $connection->commit();
                    echo "Datos actualizados correctamente del Doctor.";
                } else {
                    // Si no se actualizó ninguna fila (puede ser que los datos ya sean los mismos)
                    echo "No se realizaron cambios. Los datos pueden ser los mismos.";
                }
            } else {
                // Si falla la actualización
                $connection->rollBack();
                echo "Error al actualizar al Doctor.";
            }
            cerrarConexion($connection);
        } catch (PDOException $e) {
            // En caso de error, deshacemos la transacción y mostramos el error
            $connection->rollBack();
            echo "Error en la consulta: " . $e->getMessage();
        }
        cerrarConexion($connection);
    }
}
?>
