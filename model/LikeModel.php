<?php
namespace App\model;

use \App\model\DatabaseModel;

class LikeModel
{

    public function setLike($id_tweet,$id_user){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("insert into likes(id_tweet,id_user) values(:id_tweet,:id_user);");
            $stmt->bindParam(":id_tweet",$id_tweet,\PDO::PARAM_INT);
            $stmt->bindParam(":id_user",$id_user,\PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
    }

    public function deleteLike($id_tweet,$id_user){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("delete from likes where id_tweet=:id_tweet and id_user=:id_user;");
            $stmt->bindParam(":id_tweet",$id_tweet,\PDO::PARAM_INT);
            $stmt->bindParam(":id_user",$id_user,\PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
    }

    public function getLikeByIdTweet($id_tweet){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("select * from likes where id_tweet=:id_tweet;");
            $stmt->bindParam(":id_tweet",$id_tweet,\PDO::PARAM_INT);
            $stmt->bindParam(":id_user",$id_user,\PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }

        return $result;
    }

    public function getLikeByIdUser($id_user){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("select * from likes where id_user=:id_user;");
            $stmt->bindParam(":id_user",$id_user,\PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }

        return $result;
    }

    public function getLikeByIdTweetAndIdUser($id_tweet,$id_user){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("select * from likes where id_tweet=:id_tweet and id_user=:id_user;");
            $stmt->bindParam(":id_tweet",$id_tweet,\PDO::PARAM_INT);
            $stmt->bindParam(":id_user",$id_user,\PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }

        return $result;
    }

    public function getLikeCount($id_tweet){
        try {
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt=$db->prepare("select count(*) as 'count' from likes where id_tweet=:id_tweet;");
            $stmt->bindParam(":id_tweet",$id_tweet,\PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }
        return $result;
    }

}