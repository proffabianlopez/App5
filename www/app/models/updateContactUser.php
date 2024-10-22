<?php
require_once 'connection.php';

function updateContact($contact, $id_contact_type, $id_person){
    $connection = conectar();

    if($connection){
        $query = "SELECT COUNT(*) AS total FROM contact WHERE contact = :contact";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':contact', $contact, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['total'] > 0){
            echo "  Ya hay un contacto con esos datos.  ";
        } else{
            try {
                // Iniciamos la transacción
                $connection->beginTransaction();
                // Preparamos la consulta SQL para actualizar en la tabla 'contact'
                $queryContact = "UPDATE contact SET contact = :contact, id_contact_type = :id_contact_type WHERE id_person = :id_person";
        
                $stmtContact = $connection->prepare($queryContact);
        
                // Vincular los parámetros a las variables de PHP
                $stmtContact->bindParam(':contact', $contact, PDO::PARAM_STR);
                $stmtContact->bindParam(':id_contact_type', $id_contact_type, PDO::PARAM_INT);
                $stmtContact->bindParam(':id_person', $id_person, PDO::PARAM_INT);
        
                // Ejecutamos la consulta
                if ($stmtContact->execute()) {
                    // Si ambas consultas fueron exitosas, confirmamos la transacción
                    $connection->commit();
                    echo "Datos actualizados correctamente del contacto.";
                    // Redirigir si es necesario
                    // header('Location:../views/admin/dashboard.php');
                } else {
                    // Si falla la actualización en 'contact', deshacemos la transacción
                    $connection->rollBack();
                    echo "Error al actualizar los datos de contacto.";
                }
                cerrarConexion($connection);
            } catch (PDOException $e) {
                // En caso de error, deshacemos la transacción y mostramos el error
                $connection->rollBack();
                echo "Error en la consulta: " . $e->getMessage();
            }
        }
    }
}