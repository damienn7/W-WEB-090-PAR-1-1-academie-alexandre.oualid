<?php

namespace App\controller;

use App\model\TweetModel;
class TweetController
{

    private $data = [];


    private function renderRegisterView()
    {
        
    }

    public function isAjax(){
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest";
    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

}