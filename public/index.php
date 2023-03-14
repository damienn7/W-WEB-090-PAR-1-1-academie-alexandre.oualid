<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\controller\TweetController;
use App\controller\IndexController;
use App\controller\UserController;
use App\model\AutoloaderModel;

require_once '../model/AutoloaderModel.php';
require_once '../controller/IndexController.php';
require_once '../controller/TweetController.php';
require_once '../model/TweetModel.php';
require_once '../model/UserModel.php';
require_once '../model/DatabaseModel.php';
require_once '../model/ConfigDbModel.php';
require '../controller/UserController.php';
require_once '../view/header_connected.php';

AutoloaderModel::register();
// Définition des routes
$routes = [
    '/' => '../view/accueil.php',
    '/home_connected' => '../view/accueil_connecte.php',
    '/profil' => '../view/profil.php'
];

// Récupération de l'URL demandée
$url = $_SERVER['REQUEST_URI'];

// Si la route demandée existe
if (array_key_exists($url, $routes)) {
    // Inclure la page correspondante
    require_once $routes[$url];
} else {
    // Afficher une erreur 404
    header('HTTP/1.1 404 Not Found');
    // echo 'Page non trouvée';
}




if (!isset($_SESSION["logged_in"])) {
    if (!isset($_POST["username"])||!isset($_POST["email"])||!isset($_SESSION["logged_in"])) {
        $home = new IndexController();
        $home = $home->renderHomeView();
    }

    if (isset($_POST["submit_account"])) {
        $user = new UserController();
        $home_form_submited = $user->createUser($_POST);
        
    }

    if (isset($_POST["username"])) {
        $user_connect = new UserController();
        $resp = $user_connect->connectUser($_POST["username"], $_POST["password"]);
        if (!isset($_SESSION["logged_in"])) {
  
            header("Location: accueil.php");
            exit;
        }else{
            var_dump(headers_list());
            header("Refresh:0");
        }
    }

}

if (isset($_SESSION["logged_in"])) {
    # code...
    // var_dump($_SESSION);
    var_dump(headers_list());
    if (isset($_POST["tweet"])) {
        $tweet = new TweetController();
        $tweet->createTweet($_SESSION['id'],htmlspecialchars($_POST["tweet"]));
    }

    $connect=new IndexController();
    $connect->renderHomeViewConnected("", "", "    <form action=\"./\" method=\"POST\">
    <input type=\"text\" maxlength=\"140\" name=\"tweet\" id=\"tweet\" autocomplete=\"off\">
    <input type=\"submit\" value=\"Tweeter\" id=\"Tweeter\" name=\"submit_tweet\">
    </form>");
    echo "<script type='text/javascript'>
             $('body').load('http://localhost:8080/public/index.php');
        </script>";


    if (isset($_POST["logout"])) {

        unset($_SESSION["logged_in"]);
        unset($_SESSION["id"]);
        unset($_SESSION["username"]);
        session_destroy();
        $logout = new IndexController();
        session_start();
        header("Refresh:0");
        // header("Location: accueil.php");
    }
    // else{
    //     $home = new IndexController();
        // $content = $home->renderHomeViewConnected("", "", "    <form action=\"./\" method=\"POST\">
        // <input type=\"text\" maxlength=\"140\" name=\"tweet\" id=\"tweet\" autocomplete=\"off\">
        // <input type=\"submit\" value=\"Tweeter\" id=\"Tweeter\" name=\"submit_tweet\">
        // </form>");
    //     echo $content;
        
    //     $logout = new IndexController();
    //     $logout->redirectToRoute("./index.php",1);
    // }

}




?>