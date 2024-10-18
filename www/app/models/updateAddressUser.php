<?php
require_once 'connection.php';

function UpdateAddress($street, $number, $apartment, $floor, $id_neighborhood, $id_person){
    $connection = conectar();
    if($connection){
        try {
            // Iniciamos la transacción
            $connection->beginTransaction();
            
            // Preparamos la consulta SQL para actualizar en la tabla 'address'
            $queryAddress = "UPDATE address SET street = :street, number = :number, apartment = :apartment, floor = :floor, id_neighborhood = :id_neighborhood WHERE id_person = :id_person";
            
            $stmtAddress = $connection->prepare($queryAddress);
            
            // Vincular los parámetros a las variables de PHP
            $stmtAddress->bindParam(':street', $street, PDO::PARAM_STR);
            $stmtAddress->bindParam(':number', $number, PDO::PARAM_INT);
            $stmtAddress->bindParam(':apartment', $apartment, PDO::PARAM_STR);
            $stmtAddress->bindParam(':floor', $floor, PDO::PARAM_STR);
            $stmtAddress->bindParam(':id_neighborhood', $id_neighborhood, PDO::PARAM_INT);
            $stmtAddress->bindParam(':id_person', $id_person, PDO::PARAM_INT);

            if ($stmtAddress->execute()) {
                // Si ambas consultas fueron exitosas, confirmamos la transacción
                $connection->commit();
                echo "  Datos actualizados correctamente del domicilio.  ";
                // Redirigir si es necesario
                // header('Location:../views/admin/dashboard.php');
            } else {
                // Si falla la actualización en 'contact', deshacemos la transacción
                $connection->rollBack();
                echo "Error al actualizar la dirección.";
            }
            cerrarConexion($connection);
        } catch (PDOException $e) {
            // En caso de error, deshacemos la transacción y mostramos el error
            $connection->rollBack();
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}