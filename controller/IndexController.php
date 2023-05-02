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

        

        include_once("../view/accueil.php");
    }

    public function renderUpdateProfil($user_update){
        include("../view/accueil_connecte.php");
    }

    public function renderTweetsSearch($tweets_hashtag){
        include("../view/accueil_connecte.php");
    }

    public function renderNoResultFound(){
        $error_not_found=true;
        include('../view/accueil_connecte.php');
        return $error_not_found;
    }

    public function renderHomeProfilConnected($user,$error_not_found){
        if ($user!=false) {
            unset($error_not_found);
        
        $count=0;
        if ($user["id_follower"]!="") {
            $array=explode(",",$user["id_follower"]);
            foreach ($array as $key => $value) {
                $count++;
            }
            $followers=$count;
            $count=0;
        }else {
            $followers="0";
        }

        if ($user["id_following"]!="") {
            $array=explode(",",$user["id_following"]);
            foreach ($array as $key => $value) {
                $count++;
            }
            $followings=$count;
            $count=0;
        }else {
            $followings="0";
        }

        $tweets=new TweetController();
        $tweets_profil=$tweets->getTweetsByUserId($user["id"]);
    }

        
        include("../view/accueil_connecte.php");
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