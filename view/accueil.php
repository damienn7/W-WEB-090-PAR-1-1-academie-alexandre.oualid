<body class="container container-fluid">

    <div class="row container-fluid">
        <?php include("../view/header.php"); ?>

        <main class="col-4 middle blur logout" style="margin-left:25%;">
            <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;z-index:101;">Accueil</h2>
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
                $count_like = new App\controller\LikeController();
                $count_like = $count_like->getCountOfLikes($tweet["id_tweet"]);

                $count_like_retweet = new App\controller\LikeController();
                $count_like_retweet = $count_like_retweet->getCountOfLikes($tweet["id_tweet"]);

                $user = new App\controller\UserController();
                $user = $user->getUserInformations($tweet["id_user_tweet"]);
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                $link_array = explode("https", $tweet["message_tweet"]);
                $message = $tweet["message_tweet"];
                $message = str_replace("<", "", $message);
                if (is_int($tweet["id_retweet"])) {
                    $user_retweet = new App\controller\UserController();
                    $user_retweet = $user_retweet->getUserInformations($tweet["id_user_retweet"]);
                    $message_retweet = $tweet["message_retweet"];
                    $message_retweet = str_replace("<", "", $message_retweet);
                    $link_array2 = explode("https", $message_retweet);
                    if (isset($link_array2[1])) {
                        $space_arr2 = explode(" ", $link_array2[1]);
                        if (!isset($space_arr2[1])) {
                            # code...
                            $link_retweet = "https" . $link_array2[1];
                            $message_retweet = str_replace("$link_retweet ", "", $message_retweet);
                            // echo $message;
                        } else {
                            $link_retweet = "https" . $space_arr2[0];
                            $message_retweet = str_replace(" $link_retweet", "", $message_retweet);
                            // echo $message;
                        }
                    }
                }

                if (isset($link_array[1])) {
                    $space_arr = explode(" ", $link_array[1]);
                    if (!isset($space_arr[1])) {
                        # code...
                        $link = "https" . $link_array[1];
                        $message = str_replace("$link ", "", $message);
                        // echo $message;
                    } else {
                        $link = "https" . $space_arr[0];
                        $message = str_replace(" $link", "", $message);
                        // echo $message;
                    }
                }
                $count_retweet = [];
                $retweet = new App\controller\TweetController();
                $count_retweet = $retweet->getRetweetCount($tweet["id_tweet"]);
                ?>


                <div class="container container-fluid tweet" style="width:500px;">

                    <div class="row" style="align-items:center;">
                        <form action="./" method="post" class="row col-10">
                            <button type="submit"
                                style="background-image:url('<?php echo $user["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                name="profil">
                            </button>
                            <h3 class="col-10">
                                <?php echo $user["name"]; ?>
                            </h3>
                            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                        </form>
                        <form action="./" method="post" class="col-2">
                            <button type="submit" class="btn-link" name="like" style="text-decoration:none;" value="Like">
                                <span style="font-size:18px;">
                                    <?php echo $count_like[0]["count"]; ?> likes
                                </span>

                                <span class="material-symbols-outlined">
                                    favorite
                                </span>
                            </button>
                            <input type="hidden" name="id" value="<?php echo $tweet["id_tweet"]; ?>">
                        </form>
                    </div>
                    <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                        <?php if (isset($link) && $link != "") { ?>
                            <div class="col">
                                <p class="message" style="margin-left:20px;width:400px;padding:10px;">
                                    <?= $message ?>
                                </p>
                            </div>
                        <?php } else { ?>
                            <div class="col" style="margin-left:20px;width:400px;padding:10px;">
                                <p class="message">
                                    <?php echo str_replace("<", "", $tweet["message_tweet"]); ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if (isset($link) && $link != "") { ?>
                            <div class="col" style="width:400px;">
                                <div
                                    style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:400px;border-radius:15px;">
                                </div>
                            </div>
                        <?php }
                        $link = ""; ?>
                    </div>
                    <?php if (is_int($tweet["id_retweet"])): ?>
                        <div class="container" style="margin-top:5px;padding:20px;">
                            <div class="row" style="align-items:center;">
                                <form action="./" method="post" class="row col-10">
                                    <button type="submit"
                                        style="background-image:url('<?php echo $user_retweet["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                        name="profil">
                                    </button>
                                    <h3 class="col-10">
                                        <?php echo $user_retweet["name"]; ?>
                                    </h3>
                                    <input type="hidden" name="id" value="<?php echo $user_retweet["id"]; ?>">
                                </form>
                                <form action="./" method="post" class="col-2">
                                    <button type="submit" class="btn-link" name="like" style="text-decoration:none;"
                                        value="Like">
                                        <span style="font-size:18px;">
                                            <?php echo $count_like_retweet[0]["count"]; ?> likes
                                        </span>

                                        <span class="material-symbols-outlined">
                                            favorite
                                        </span>
                                    </button>
                                    <input type="hidden" name="id" value="<?php echo $tweet["id_retweet"]; ?>">
                                </form>
                            </div>
                            <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                                <?php if (isset($link_retweet) && $link_retweet != "") { ?>
                                    <div class="col">
                                        <p class="message" style="margin-left:20px;width:400px;padding:10px;">
                                            <?= $message_retweet ?>
                                        </p>
                                    </div>
                                <?php } else { ?>
                                    <div class="col" style="margin-left:20px;width:400px;padding:10px;">
                                        <p class="message">
                                            <?php echo str_replace("<", "", $tweet["message_retweet"]); ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if (isset($link_retweet) && $link_retweet != "") { ?>
                                    <div class="col" style="width:400px;">
                                        <div
                                            style="background-image:url('<?= $link_retweet; ?>');background-size:100%;height:200px;width:400px;border-radius:15px;">
                                        </div>
                                    </div>
                                <?php }
                                $link_retweet = ""; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="row" style="width:400px;margin:auto;">
                        <form action="./" method="POST">
                            <input type="hidden" name="id_tweet" value="<?php echo $tweet["id_tweet"] ?>">
                            <div class="col" style="padding:2px;text-align:center;align-items:center;">
                                <input type="text" name="message_reply">
                                <button type="submit" name="reply" id="reply" class="btn-link" style="text-decoration:none;"
                                    value="Répondre"><span class="material-symbols-outlined">
                                        chat_bubble
                                    </span></button>
                            </div>
                        </form>
                        <form action="./" method="POST">
                            <div class="col" style="padding:2px;">
                                <input type="text" name="message_retweet">

                                <button type="submit" class="btn-link" name="retweet" id="retweet"
                                    style="text-decoration:none;" value="Retweeter"><span class="material-symbols-outlined">
                                        repeat
                                    </span></button>
                            </div>
                        </form>
                    </div>

                    <?php
                    $count_reply = [];
                    $reply = new App\controller\TweetController();
                    $count_reply = $reply->getReplyCount($tweet["id_tweet"]);
                    $reply_tweet = $reply->getReply($tweet["id_tweet"]); ?>
                    <div class="row" style="width:400px;margin:auto;">
                        <div class="col">
                            <span>
                                <?php echo $count_reply[0]["count(*)"]; ?> reponses
                            </span>
                        </div>
                        <div class="col">
                            <span>
                                <?php echo $count_retweet[0]["count(*)"]; ?> retweet
                            </span>
                        </div>
                    </div>

                    <?php
                    // var_dump($reply_tweet);
                    foreach ($reply_tweet as $key => $reply_t) {
                        # code...
                        $count_like = new App\controller\LikeController();
                        $count_like = $count_like->getCountOfLikes($reply_t["id_tweet"]);

                        $user_reply = new App\controller\UserController();
                        $user_reply = $user_reply->getUserInformations($reply_t["id_user_tweet"]);
                        $message_reply = $reply_t["message_tweet"];
                        $message_reply = str_replace("<", "", $message_reply);
                        $link_array3 = explode("https", $message_reply);

                        if (isset($link_array3[1])) {
                            $space_arr3 = explode(" ", $link_array3[1]);
                            if (!isset($space_arr3[1])) {
                                # code...
                                $link_reply = "https" . $link_array3[1];
                                $message_reply = str_replace("$link_reply ", "", $message_reply);
                                // echo $message;
                            } else {
                                $link_reply = "https" . $space_arr3[0];
                                $message_reply = str_replace(" $link3", "", $message_reply);
                                // echo $message;
                            }
                        }
                        ?>

                        <div class="container" style="margin-top:5px;padding:10px;margin-left:20px;margin-right:20px;">
                            <div class="row" style="align-items:center;">
                                <form action="./" method="post" class="row col-10">
                                    <button type="submit"
                                        style="background-image:url('<?php echo $user_reply["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                        name="profil">
                                    </button>
                                    <h3 class="col-10">
                                        <?php echo $user_reply["name"]; ?>
                                    </h3>
                                    <input type="hidden" name="id" value="<?php echo $user_reply["id"]; ?>">
                                </form>
                                <form action="./" method="post" class="col-2">
                                    <button type="submit" class="btn-link" name="like" style="text-decoration:none;"
                                        value="Like">
                                        <span style="font-size:18px;">
                                            <?php echo $count_like[0]["count"]; ?> likes
                                        </span>

                                        <span class="material-symbols-outlined">
                                            favorite
                                        </span>
                                    </button>
                                    <input type="hidden" name="id" value="<?php echo $reply_t["id_tweet"]; ?>">
                                </form>
                            </div>
                            <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                                <?php if (isset($link_reply) && $link_reply != "") { ?>
                                    <div class="col">
                                        <p class="message" style="margin-left:20px;width:400px;padding:10px;">
                                            <?= $message_reply ?>
                                        </p>
                                    </div>
                                <?php } else { ?>
                                    <div class="col" style="margin-left:20px;width:400px;padding:10px;">
                                        <p class="message">
                                            <?php echo str_replace("<", "", $reply_t["message_tweet"]); ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if (isset($link_reply) && $link_reply != "") { ?>
                                    <div class="col" style="width:400px;">
                                        <div
                                            style="background-image:url('<?= $link_reply; ?>');background-size:100%;height:200px;width:400px;border-radius:15px;">
                                        </div>
                                    </div>
                                <?php }
                                $link_reply = ""; ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <?php
            }

            ?>
        </main>
    </div>
    <?php if ($form == "" || !isset($_SESSION["logged_in"])): ?>
        <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="z-index:3000;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="./" method="POST" id="register_account">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create account</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                            </button>
                        </div>


                        <div class="modal-body" style="padding:5px;">
                            <div class="row">
                                <label for="email" class="col-4">Email</label>
                                <input autocomplete="off" class="col-6" type="email" name="email" id="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="row">
                                <label for="password" class="col-4">Password</label>
                                <input type="password" name="password" class="col-6" required minlength="8" maxlength="15"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                            </div>

                            <div class="row">
                                <label for="name" class="col-4">Firstname Lastname</label>
                                <input type="text" class="col-6" name="name" required>
                            </div>

                            <div class="row">
                                <label for="username" class="col-4">Username</label>
                                <input type="text" class="col-6" name="username" required>
                            </div>
                            <div class="row">
                                <label for="birthdate" class="col-4">Birthdate</label>
                                <input type="date" class="col-6" name="birthdate" required>
                            </div>
                            <div class="row">

                                <label for="gender" class="col-4">Gender</label>
                                <select name="gender" id="gender" class="col-6" required>
                                    <option value="Autre">Autre</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="city" class="col-4">City</label>
                                <input type="text" name="city" class="col-6" id="city" required>
                            </div>
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
                    <form action="./" method="POST" id="login_account">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body" style="padding:40px;">
                            <div class="row">
                                <label for="username" class="col-4">Username</label>
                                <input type="text" name="username" class="col-6" id="username" required>
                            </div>
                            <div class="row">
                                <label for="password" class="col-4">Password</label>
                                <input type="password" name="password" class="col-6" id="password" required>
                            </div>
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
    <?php if (!isset($_SESSION["logged_in"])): ?>
        <footer class="col blocks blur logout">


            <h1>Se connecter</h1>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-blue-twitter" name="login" data-toggle="modal" id="login"
                        data-target="#login-modal">Connexion</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-blue-twitter" id="register" name="register" data-toggle="modal"
                        data-target="#register-modal">Inscription</button>
                </div>
            </div>

        </footer>

        <div class="banner blur">
            <div class=" login container-fluid row">

                <div class="col-2">
                    <button class="btn btn-blue-twitter" id="login2" name="login" data-toggle="modal"
                        data-target="#login-modal">Connexion</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-blue-twitter" id="register2" name="register" data-toggle="modal"
                        data-target="#register-modal">Inscription</button>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- <script src="../public/js/refresh.js"></script> -->
</body>