<?php
session_start();

use App\controller\IndexController;
use App\controller\UserController;
use App\model\AutoloaderModel;

require '../model/AutoloaderModel.php';
require '../controller/IndexController.php';
require '../controller/UserController.php';

AutoloaderModel::register();

if (!isset($_SESSION["LOGGED_USER"])) {
//    if (!isset($_POST)) {
       $home = new IndexController();
       $home = $home->renderHomeView();
       echo $home;
//    }
}

?>