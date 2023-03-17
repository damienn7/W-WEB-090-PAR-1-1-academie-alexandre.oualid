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


// $routes = [
//     '/' => '../view/accueil.php',
//     '/home_connected' => '../view/accueil_connecte.php',
//     '/profil' => '../view/profil.php'
// ];


// $url = $_SERVER['REQUEST_URI'];


// if (array_key_exists($url, $routes)) {

//     require_once $routes[$url];
// } else {

//     header('HTTP/1.1 404 Not Found');
//     echo 'Page non trouvée';
//     exit;
// }

        include('../view/accueil_connecte.php');


    }

    public function renderHomeView($alert_success = "", $alert_danger = "", $form = "")
    {
        $tweets = new TweetModel();
        $tweets = $tweets->getTweets();

        include("../view/accueil.php");


    }

    public function renderHomeProfilConnected($user){
        if ($user["id_follower"]!="") {
            $followers=array_count_values(explode(",",$user["id_follower"]));
        }else {
            $followers="0";
        }

        if ($user["id_following"]!="") {
            $followings=array_count_values(explode(",",$user["id_following"]));
        }else {
            $followings="0";
        }

        
        include("../view/profil2.php");
    }

    public function renderTweetsSearch($tweets_hastag){
        include("accueil_connecte.php");
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