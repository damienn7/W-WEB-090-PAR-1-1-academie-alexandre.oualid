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

        ob_start();

        require("../view/header_connected.php");



        ?>

        <main class="col-4 middle blur">
            <!-- <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2> -->
            <?php if ($alert_success != ""): ?>
                <div class="row">
                    <div class="col">
                        <p class="alert-success">
                            <?= $alert_success ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($alert_danger != ""): ?>
                <div class="row">
                    <div class="col">
                        <p class="alert-success">
                            <?= $alert_danger ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col">
                    <?= $form ?>
                </div>
            </div>

            <?php
            foreach ($tweets as $key => $tweet) {
                $user = new UserController();
                $user = $user->getUserInformations($tweet["id_user"]);
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                ?>

                <div class="container container-fluid ">
                    <div class="row" style="align-items:center;">
                        <img src="<?php echo $avatar; ?>" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;">
                        <h3 class="col-10">
                            <?php echo $user["name"]; ?>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="message">
                                <?= $tweet["message"] ?>
                            </p>
                        </div>
                    </div>
                </div>



                <?php
            }

            ?>
        </main>
        <?php


        require("../view/footer_connected.php");


        $content = ob_get_clean();

        ob_end_clean();

        return $content;

    }

    public function renderHomeView($alert_success = "", $alert_danger = "", $form = "")
    {
        $tweets = new TweetModel();
        $tweets = $tweets->getTweets();

        ob_start();

            require("../view/header.php");
        


        ?>

        <main class="col-4 middle blur">
            <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2>
            <?php if ($alert_success != ""): ?>
                <div class="row">
                    <div class="col">
                        <p class="alert-success">
                            <?= $alert_success ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($alert_danger != ""): ?>
                <div class="row">
                    <div class="col">
                        <p class="alert-success">
                            <?= $alert_danger ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <!-- <div class="col">
                                        <form action="" method="POST">
                                            <input type="text" maxlength="140" name="tweet" id="tweet" autocomplete="off">
                                            <input type="submit" value="Tweeter" id="Tweeter" name="submit">
                                        </form>
                                    </div> -->
                <div class="col">
                    <?= $form ?>
                </div>
            </div>

            <?php
            foreach ($tweets as $key => $tweet) {
                $user = new UserController();
                $user = $user->getUserInformations($tweet["id_user"]);
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                ?>

                <div class="container container-fluid ">
                    <div class="row" style="align-items:center;">
                        <img src="<?php echo $avatar; ?>" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;">
                        <h3 class="col-10">
                            <?php echo $user["name"]; ?>
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="message">
                                <?= $tweet["message"] ?>
                            </p>
                        </div>
                    </div>
                </div>



                <?php
            }

            ?>
        </main>
        <?php if ($form == "" || !isset($_SESSION["logged_in"])): ?>
            <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="z-index:3000;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="./" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create account</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-error">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <label for="email">Email</label>
                                <input autocomplete="off" type="email" name="email" id="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
                                <label for="password">Password</label>
                                <input type="password" name="password" required><br>
                                <label for="name">Firstname Lastname</label>
                                <input type="text" name="name" required><br>
                                <label for="username">Username</label>
                                <input type="text" name="username" required><br>
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" required><br>
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" required>
                                    <option value="Autre">Autre</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select><br>
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" required><br>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit_account" id="submit_account"
                                    class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="./" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-error">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" required><br>
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" required><br>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                                <button type="submit" name="connect_account" id="connect_account"
                                    class="btn btn-primary">Connection</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php


            require("../view/footer.php");
        

        $content = ob_get_clean();

ob_end_clean();

        return $content;
    }

    // public function renderHomeViewConnected()
    // {

    // }

    public function isAjax()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
    }

    public function redirectToRoute($location = "homeView")
    {
        header('Location: http://localhost:8080/view/' . $location . '.php');
    }

}