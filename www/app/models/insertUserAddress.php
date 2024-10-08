<?php
require_once 'connection.php';

function insertAddress($street, $number, $apartment, $floor, $id_neighborhood, $id_person, $id_address_type){
    $connection = conectar();
    if($connection){
        try {
            // Iniciamos la transacción
            $connection->beginTransaction();
            
            // Preparamos la consulta SQL para actualizar en la tabla 'address'
            $queryAddress = "INSERT INTO address (street, number, apartment, floor, id_neighborhood, id_person, id_address_type) VALUES (:street, :number, :apartment, :floor, :id_neighborhood, :id_person, :id_address_type)";
            
            $stmtAddress = $connection->prepare($queryAddress);
            
            // Vincular los parámetros a las variables de PHP
            $stmtAddress->bindParam(':street', $street, PDO::PARAM_STR);
            $stmtAddress->bindParam(':id_address_type', $id_address_type, PDO::PARAM_INT);
            $stmtAddress->bindParam(':number', $number, PDO::PARAM_INT);
            $stmtAddress->bindParam(':apartment', $apartment, PDO::PARAM_STR);
            $stmtAddress->bindParam(':floor', $floor, PDO::PARAM_STR);
            $stmtAddress->bindParam(':id_neighborhood', $id_neighborhood, PDO::PARAM_INT);
            $stmtAddress->bindParam(':id_person', $id_person, PDO::PARAM_INT);

            if ($stmtAddress->execute()) {
                // Si ambas consultas fueron exitosas, confirmamos la transacción
                $connection->commit();
                echo "Datos insertados de domicilio correctamente.";
                // Redirigir si es necesario
                // header('Location:../views/admin/dashboard.php');
            } else {
                // Si falla la actualización en 'contact', deshacemos la transacción
                $connection->rollBack();
                echo "Error al insertar los datos de la dirección.";
            }
            cerrarConexion($connection);
        } catch (PDOException $e) {
            // En caso de error, deshacemos la transacción y mostramos el error
            $connection->rollBack();
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}