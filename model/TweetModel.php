<?php
namespace App\model;

use \App\model\DatabaseModel;

class TweetModel
{
    private $id;

    private $id_user;
    
    private $message;

    private $date_send;

    public function setTweet($id,$tweet)
    {
        try{
            $sql = "INSERT INTO tweet(id_user,message) VALUES (:id,:tweet)";
            $db = new DatabaseModel();
            $db=$db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':tweet', $tweet,\PDO::PARAM_STR_CHAR);
            $stmt->bindParam(':id', $id,\PDO::PARAM_INT);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Une erreur est survenue veuillez remplir le formulaire correctement.";
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
            $query = "select tweet.id as \"id_tweet\",tweet.message as \"message_tweet\",tweet.date_send as \"date_tweet\", tweet.message as \"message_tweet\",tweet.id_user as \"id_user_tweet\", t.message as \"message_retweet\",t.id_user as \"id_user_retweet\",t.date_send as \"date_send_retweet\", t.id as \"id_retweet\" from tweet left outer join tweet as t on tweet.id_retweet = t.id limit 10;";
            //select tweet.id,tweet.message,tweet.date_send as \"date_tweet\", from tweet left outer join tweet as t on tweet.id_retweet = t.id linit 20;
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