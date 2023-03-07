<?php
namespace App\model;

use \App\model\DatabaseModel;

class TweetModel
{
    private $id;

    private $id_user;
    
    private $message;

    private $date_send;

    public function setTweet($data)
    {


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
            $query = "select * from tweet order by id desc limit 80;";
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