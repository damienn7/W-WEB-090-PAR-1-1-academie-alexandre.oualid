<?php

namespace App\controller;

use App\model\UserModel;

class UserController
{

    private $data = [];


    private function renderRegisterView()
    {
        header('Location: http://localhost:8080/view/registerFormView.php');
    }

    public function getUserInformations($id)
    {
        $user=new UserModel();
        return $user->getUser($id);
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