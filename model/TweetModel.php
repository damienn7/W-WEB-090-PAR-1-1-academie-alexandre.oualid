<?php
namespace App\model;

use \App\model\DatabaseModel;

class TweetModel
{
    private $id;

    private $id_user;
    
    private $message;

    private $date_send;

    public function setTweet($id,$tweet,$addPic)
    {
        try{
            $tweet = $tweet." ".$addPic;
            $sql = "INSERT INTO tweet(id_user,message) VALUES (:id,:tweet)";
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id,\PDO::PARAM_INT);
            $stmt->bindParam(':tweet', $tweet,\PDO::PARAM_STR_CHAR);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Une erreur est survenue";
            die('Erreur : ' . $e->getMessage());
        }

    }

    public function setRetweet($id,$retweet,$id_retweet,$addPicRT)
    {
        try{
            $retweet = $retweet." ".$addPicRT;
            $sql = "INSERT INTO tweet (id_user, message, id_retweet)  VALUES (:id_user,:retweet,:id_retweet)";
            $db = new DatabaseModel();
            $db =  $db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_user', $id,\PDO::PARAM_INT);
            $stmt->bindParam(':retweet', $retweet,\PDO::PARAM_STR_CHAR);
            $stmt->bindParam(':id_retweet',$id_retweet,\PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Une erreur est survenue";
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function setReply($id,$reply,$id_reply,$addPicReply)
    {
        try{
            $reply = $reply." ".$addPicReply;
            $sql = "INSERT INTO tweet (id_user, message, id_reply_tweet)  VALUES (:id_user,:reply,:id_reply)";
            $db = new DatabaseModel();
            $db =  $db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_user', $id,\PDO::PARAM_INT);
            $stmt->bindParam(':reply', $reply,\PDO::PARAM_STR_CHAR);
            $stmt->bindParam(':id_reply',$id_reply,\PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Une erreur est survenue";
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getTweet($id)
    {
        try {
            $query = "select * from tweet where id=:id;";
            $db = new DatabaseModel();
            $db=$db->pdo;
            $statement=$db->prepare($query);
            $statement->bindParam("id",$id,\PDO::PARAM_INT);
            $statement->execute();
            $tweet=$statement->fetch();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }

        return $tweet;
    }

    public function getTweets()
    {
        try {
            $query = "select * from tweet order by id desc limit 20;";
            $db = new DatabaseModel();
            $db=$db->pdo;
            $statement=$db->prepare($query);
            $statement->execute();
            $tweets=$statement->fetchAll();
        } catch (\Exception $e) {
            die("Erreur : ".$e->getMessage());
        }

        return $tweets;
    }

    private function getDatetime($year, $month, $day): string
    {
        $datetime = new \DateTime();
        $datetime->setDate(intval($year), intval($month), intval($day));
        $datetime->setTime(0, 0, 0, 0);
        $date = $datetime->format('Y-m-d H:i:s');
        return $date;
    }
}