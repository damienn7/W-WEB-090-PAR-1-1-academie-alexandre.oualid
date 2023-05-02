<?php

namespace App\controller;

use App\model\UserModel;

class UserController
{

    private $data = [];

    public function getUserInformations($id)
    {
        $user = new UserModel();
        $response = $user->getUserById($id);

        return $response;
    }

    public function connectUser($username, $password)
    {
        $user = new UserModel();
        $response = $user->getUserByUsername($username);

        $salt = "vive le projet tweet_academy";
        $salted_password = $salt . $password;
        $hashed_password = hash('ripemd160', $salted_password);
        if ($hashed_password === $response["password"]&&$response["disabled"]===0) {
            // session_start();
            $_SESSION['logged_in'] = "logged";
            $_SESSION['username'] = $response["username"];
            $_SESSION['id'] = $response["id"];

            return "ok";

        }

    return "nok";



    }

    public function createUser($data_received)
    {
        $content = "";
        $email = htmlspecialchars($data_received["email"]);
        

        $password = htmlspecialchars($data_received["password"]);
        $name = htmlspecialchars($data_received["name"]);
        $username = htmlspecialchars($data_received["username"]);
        $user = new UserModel();
        $response = $user->getUserByUsername($username);
        if (isset($response["username"])) {
            return;
        }
        $birthdate = $data_received["birthdate"];
        $gender = htmlspecialchars($data_received["gender"]);
        $city = htmlspecialchars($data_received["city"]);
        $avatar = "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
        $banner = "https://cdn.discordapp.com/attachments/1077191464683048980/1080783037127741540/fond_bleu_clair.png";

        $data = [$email, $password, $name, $username, $birthdate, $gender, $city, $avatar, $banner];

        $userModel = new UserModel();
        $userModel->setUser($data);
        
    }

    public function search($search){
        $user = new UserModel();
        $infos=$user->getUserByUsername($search);

        return $infos;
    }

    public function followUser($id_following,$id_follower,$new_following,$new_follower){
        $follow = new UserModel();
        $follow->setFollow($id_following,$id_follower,$new_following,$new_follower);
    }

    public function unfollowUser($id_following,$id_follower,$new_following,$new_follower){
        $follow = new UserModel();
        $follow->unsetFollow($id_following,$id_follower,$new_following,$new_follower);
    }

    public function updateProfil($post=[]){
        $update = new UserModel();
        $update->updateUser($post);
    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

}