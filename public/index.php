<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\controller\IndexController;
use App\controller\UserController;
use App\model\AutoloaderModel;

require_once '../model/AutoloaderModel.php';
require_once '../controller/IndexController.php';
require_once '../controller/UserController.php';

AutoloaderModel::register();

if (!isset($_SESSION["PHPSESSID"])) {
    if (!isset($_POST["email"])) {
        $home = new IndexController();
        $home = $home->renderHomeView();
        echo $home;
    }

    if (isset($_POST["submit_account"])) {
        $user = new UserController();
        $home_form_submited = $user->createUser($_POST);
        echo $home_form_submited;
    }

    if (isset($_POST["connect_account"])) {
        $user_connect = new UserController();
        $resp = $user_connect->connectUser($_POST["username"],$_POST["password"]);

        echo $resp;
    

    }

}else{
    $home = new IndexController();
    $content = $home->renderHomeViewConnected("", "", "    <form action=\"./\" method=\"POST\">
<input type=\"text\" maxlength=\"140\" name=\"tweet\" id=\"tweet\" autocomplete=\"off\">
<input type=\"submit\" value=\"Tweeter\" id=\"Tweeter\" name=\"submit\">
</form>");
}




?>