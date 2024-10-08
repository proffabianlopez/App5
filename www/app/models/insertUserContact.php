<?php
require_once 'connection.php';

function insertContact($contact, $id_contact_type, $id_person){
    $connection = conectar();
    if($connection){
        try {
            // Iniciamos la transacción
            $connection->beginTransaction();
            
            // Preparamos la consulta SQL para actualizar en la tabla 'address'
            $queryAddress = "INSERT INTO contact (id_person, id_contact_type, contact) VALUES (:id_person, :id_contact_type, :contact)";
            
            $stmtAddress = $connection->prepare($queryAddress);
            
            // Vincular los parámetros a las variables de PHP
            $stmtAddress->bindParam(':id_person', $id_person, PDO::PARAM_INT);
            $stmtAddress->bindParam(':id_contact_type', $id_contact_type, PDO::PARAM_INT);
            $stmtAddress->bindParam(':contact', $contact, PDO::PARAM_STR);

            if ($stmtAddress->execute()) {
                // Si ambas consultas fueron exitosas, confirmamos la transacción
                $connection->commit();
                echo "Datos de contacto insertados correctamente.";
                // Redirigir si es necesario
                // header('Location:../views/admin/dashboard.php');
            } else {
                // Si falla la actualización en 'contact', deshacemos la transacción
                $connection->rollBack();
                echo "Error al insertar los datos de contacto.";
            }
            cerrarConexion($connection);
        } catch (PDOException $e) {
            // En caso de error, deshacemos la transacción y mostramos el error
            $connection->rollBack();
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}