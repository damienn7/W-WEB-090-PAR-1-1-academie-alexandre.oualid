<?php

namespace App\controller;

use App\model\TweetModel;
use App\controller\UserController;

class IndexController
{

    private $data = [];


    public function renderHomeView()
    {
        $tweets = new TweetModel();
        $tweets = $tweets->getTweets();

        // var_dump($tweets);

        // die();

        ob_start();

        require("../view/header.php");

        ?><main class="col-4 middle">
            <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2><?php
        foreach ($tweets as $key => $tweet) {
            $user = new UserController();
            $user=$user->getUserInformations($tweet["id_user"]);
            // var_dump($user);

            // die();
            ?>

            <div class="container container-fluid ">
                <div class="row">
                    <h3 class="col"><?php echo $user["name"]; ?></h3>
                    <img src="../public/img/egg_twitter_blue.png" alt="photo" class="img-thumbnail col">
                </div>
                <div class="row">
                    <div class="col"><p class="message"><?=$tweet["message"]?></p></div>
                </div>
            </div>
        

            <?php
        }

        ?></main><?php

        require("../view/footer.php");

        $content=ob_get_clean();

        return $content;
    }

    public function renderHomeViewConnected()
    {

    }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

}