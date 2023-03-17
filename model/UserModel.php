<?php

namespace App\model;

use \App\model\DatabaseModel;

class UserModel
{
    private $id;

    private $email;

    private $password;

    private $name;

    private $genre_id;


    // public function __construct() {

    // }

    function setUser($data)
    {
        //$data = [$email,$password,$name,$username,$birthdate,$gender,$city,$avatar,$banner];

        $salt = "vive le projet tweet_academy";
        $password_hash = hash('ripemd160', $salt . $data[1]);

        try {

            $sql = "INSERT INTO users (banner, avatar, email, password, name, username, birthdate, gender, city)
                VALUES (:banner, :avatar, :email, :password, :name, :username, :birthdate, :gender, :city)";
            $db = new DatabaseModel();
            $db = $db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':banner', $data[8]);
            $stmt->bindParam(':avatar', $data[7]);
            $stmt->bindParam(':email', $data[0]);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':name', $data[2]);
            $stmt->bindParam(':username', $data[3]);
            $stmt->bindParam(':birthdate', $data[4]);
            $stmt->bindParam(':gender', $data[5]);
            $stmt->bindParam(':city', $data[6]);

            $stmt->execute();
        } catch (\Exception $e) {
            $message = "Erreur : " . $e->getMessage();
            // die('Erreur : ' . $e->getMessage());
            return $message;
        }
        return "success";
    }

    public function getUserById($id)
    {
        try {
            $query = "select * from users where id=:id;";
            $db = new DatabaseModel();
            $db = $db->pdo;
            $statement = $db->prepare($query);
            $statement->bindParam("id", $id, \PDO::PARAM_INT);
            $statement->execute();
            $user = $statement->fetch();
        } catch (\Exception $e) {
            die("Erreur : " . $e->getMessage());
        }

        return $user;
    }

    public function getUserByUsername($username)
    {
        try {
            // Récupérer l'utilisateur correspondant au nom d'utilisateur
            $sql = "SELECT * FROM users WHERE username = :username";
            $db = new DatabaseModel();
            $db = $db->pdo;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch();
        } catch (\Exception $e) {
            die("Erreur : " . $e->getMessage());
            // return $message;
        }

        return $user;
    }

    public function getUsers($city = 'Paris', $min = 18, $max = 60, $hobbies = "")
    {
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
