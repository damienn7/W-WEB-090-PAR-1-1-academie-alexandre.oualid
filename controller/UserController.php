<?php

namespace App\controller;

use App\model\UserModel;
use App\controller\IndexController;

class UserController
{

    private $data = [];


    private function renderRegisterView()
    {
        header('Location: http://localhost:8080/view/registerFormView.php');
    }

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
        if ($hashed_password === $response["password"]) {

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
        $birthdate = $data_received["birthdate"];
        $gender = htmlspecialchars($data_received["gender"]);
        $city = htmlspecialchars($data_received["city"]);
        $avatar = "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
        $banner = "https://cdn.discordapp.com/attachments/1077191464683048980/1080783037127741540/fond_bleu_clair.png";

        $data = [$email, $password, $name, $username, $birthdate, $gender, $city, $avatar, $banner];

        $userModel = new UserModel();
        $response = $userModel->setUser($data);

        if ($response == "success") {
            $home = new IndexController();
            $content = $home->renderHomeView("Votre compte a ete cree avec succes !", "", "");
        } else {
            $home = new IndexController();
            $content = $home->renderHomeView("", "Erreur : Nous n'avons pas pu creer votre compte ... Veuillez reessayer !", "");
        }

        return $content;
    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
    }

    public function getAllProfiles($city = "Paris", $min = 18, $max = 60, $post = "")
    {

    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

}