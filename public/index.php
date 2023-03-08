<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\controller\IndexController;
use App\controller\UserController;
use App\model\AutoloaderModel;
use App\controller\TweetController;

require '../model/AutoloaderModel.php';
require '../controller/IndexController.php';
require '../controller/UserController.php';
require '../controller/TweetController.php';

AutoloaderModel::register();

if (!isset($_SESSION["logged_user"])) {
//    if (!isset($_POST)) {
       $home = new IndexController();
       $home = $home->renderHomeView();
       echo $home;
//    }
}
if(isset($_SESSION["logged_user"])){
       $home = new IndexController();
       $home = $home->renderHomeViewConnected();
       echo $home;
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
       
              $tweet = $_POST["tweet"];
              $id = $_SESSION["id"];
              // echo "Bonjour".$_SESSION["id"].$_POST["tweet"];
              
              $bjr = new TweetController();
              $bjr = $bjr->createTweet($id,$tweet);
          }
}