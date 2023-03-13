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

        ob_start();

        require("../view/header.php");

?><main class="col-4 middle">
            <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2>
            <?php
            foreach ($tweets as $key => $tweet) {
                $user = new UserController();
                $user = $user->getUserInformations($tweet["id_user"]);
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                // var_dump($user);

                // die();
            ?>
                <div class="container container-fluid ">
                    <form action="" method="POST">
                        <div class="row" style="align-items:center;">
                            <img src="<?php echo $avatar; ?>" class="col" alt="profile image" style="width:40px;height:auto;padding:10px;border-radius:50%;">
                            <h3 class="col-10"><?php echo $user["name"]; ?></h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="message"><?= $tweet["message"] ?></p>
                            </div>
                        </div>
                    </form>
                </div>


            <?php
            }

            ?>
        </main><?php

                require("../view/footer.php");

                $content = ob_get_clean();

                return $content;
            }

            public function renderHomeViewConnected()
            {
                $tweets = new TweetModel();
                $tweets = $tweets->getTweets();

                ob_start();

                require("../view/header.php");

                ?><main class="col-4 middle">
                    
            <form action="" method="POST">
                <input type="text" maxlength="140" name="tweet" id="tweet" autocomplete="off">
                <input type="file" id="photo" name="photo">
                <input type="submit" value="Tweeter" id="Tweeter" name="submit">
            </form>
            <!-- <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2> -->
            <?php
                foreach ($tweets as $key => $tweet) {
                    $user = new UserController();
                    $user = $user->getUserInformations($tweet["id_user"]);
                    $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";

            ?>

                <div class="container container-fluid ">
                    <form action="" method="POST">
                        <div class="row" style="align-items:center;">
                            <img src="<?php echo $avatar; ?>" class="col" alt="profile image" style="width:40px;height:auto;padding:10px;border-radius:50%;">
                            <h3 class="col-10"><?php echo $user["name"]; ?></h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="message"><?= $tweet["message"] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="id_tweet" value="<?php echo $tweet["id"] ?>">
                            <div class="col">
                                <input type="text" name="message_reply">
                                <input type="file" id="addPicReply" name="addPicReply">
                                <input type="submit" name="reply" id="reply" value="Répondre">
                            </div>
                            <div class="col">
                                <input type="text" name="message_retweet">
                                <input type="file" id="addPicRT" name="addPicRT">
                                <input type="submit" name="retweet" id="retweet" value="Retweeter">
                            </div>
                        </div>
                    </form>
                </div>


            <?php
                }

            ?>
        </main><?php

                require("../view/footer.php");

                $content = ob_get_clean();

                return $content;
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
