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
if (isset($_SESSION["logged_user"])) {
       $home = new IndexController();
       $home = $home->renderHomeViewConnected();
       echo $home;
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

              $tweet = $_POST["tweet"];
              $id = $_SESSION["id"];
              $addPic = $_POST["photo"];

              $a = new TweetController();
              $a = $a->createTweet($id, $tweet,$addPic);
       }

       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["retweet"])){
              $retweet = $_POST["message_retweet"];
              $id = $_SESSION["id"];
              $id_retweet = $_POST["id_tweet"];
              $addPicRT = $_POST["addPicRT"];

              $b = new TweetController();
              $b = $b->createRetweet($id,$retweet,$id_retweet,$addPicRT);
       }
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reply"])){
              $reply = $_POST["message_reply"];
              $id = $_SESSION["id"];
              $id_reply = $_POST["id_tweet"];
              $addPicRT = $_POST["addPicReply"];

              $b = new TweetController();
              $b = $b->createreply($id,$reply,$id_reply,$addPicRT);
       }
}
