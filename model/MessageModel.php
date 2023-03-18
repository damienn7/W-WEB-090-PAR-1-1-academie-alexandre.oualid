<?php
namespace App\model;

use \App\model\DatabaseModel;

class MessageModel{
    function sendMessage($id_user,$id_receiver,$mp){
        try{
            $db = new DatabaseModel();
            $db =  $db->pdo;
            $sql = "INSERT INTO private_message (id_sender, id_receiver, message) VALUES (:id_user, :id_receiver, :mp)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id_user", $id_user, \PDO::PARAM_INT);
            $stmt->bindParam(":id_receiver", $id_receiver, \PDO::PARAM_INT);
            $stmt->bindParam(":mp", $mp, \PDO::PARAM_STR_CHAR);
            $stmt->execute();
        } catch (\Exception $e) {
        echo "Une erreur est survenue";
        die('Erreur : ' . $e->getMessage());
    }
    }
}