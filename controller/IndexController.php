<?php

namespace App\controller;

use App\model\TweetModel;
use App\controller\UserController;

class IndexController
{

    private $data = [];

    public function renderHomeViewConnected($alert_success = "", $alert_danger = "", $form = "")
    {
        $tweets = new TweetModel();
        $tweets = $tweets->getTweets();

        include('../view/accueil_connecte.php');

    }

    public function renderHomeView($alert_success = "", $alert_danger = "", $form = "")
    {
        $tweets = new TweetModel();
        $tweets = $tweets->getTweets();

        include("../view/accueil.php");
    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
    }

    public function redirectToRoute($url = "./index.php",$time=1)
    {
            $temps = $time * 1000;
           
            echo "<script type=\"text/javascript\">\n"
               . "\n"
               . "once(function(){\n"
               . "window.location = '" . $url . "';\n"
               . "})\n"
 //              . "setTimeout('redirected()','" . $temps ."');\n"
               . "\n"
               . "</script>\n";   
          
    }

}