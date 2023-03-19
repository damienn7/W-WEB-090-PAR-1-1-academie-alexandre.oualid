<body class="container container-fluid">
    <div class="row container-fluid">

        <?php include("../view/header.php");
        use App\controller\TweetController; ?>
        <main class="col-6 middle blur">
            <div style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;z-index:101;">
                <!-- <h2>Accueil</h2> -->
                <form action="index.php" method="post">
                    <label for="search" style="font-size:16px;">Rechercher :</label>
                    <input type="text" name="search" id="search" style="padding:5px;border-radius:20px;">
                    <input type="submit" value="Rechercher" class="btn btn-primary">
                </form>
            </div>

            <?php if (!isset($_POST["search"]) && !isset($_POST["my_profile"])): ?>


                <div class="row">
                    <div class="col">
                        <?= $form ?>
                    </div>
                </div>

                <?php
                foreach ($tweets as $key => $tweet) {
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
                                $message_retweet = str_replace("$link ", "", $message_retweet);
                                // echo $message;
                            } else {
                                $link_retweet = "https" . $space_arr2[0];
                                $message_retweet = str_replace(" $link", "", $message_retweet);
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
                    ?>


                    <div class="container container-fluid tweet" style="width:500px;">

                        <div class="row" style="align-items:center;">
                            <form action="./" method="post">
                                <button type="submit"
                                    style="background-image:url('<?php echo $user["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                    name="profil">
                                </button>
                                <h3 class="col-10">
                                    <?php echo $user["name"]; ?>
                                </h3>
                                <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
                            </form>
                            <form action="./" method="post">
                                <button type="submit" class="btn-link col-2" name="like" style="text-decoration:none;"
                                    value="Like">
                                    <span class="material-symbols-outlined">
                                        favorite
                                    </span>
                                </button>
                                <input type="hidden" name="id" value="<?php echo $tweet["id"]; ?>">
                            </form>
                        </div>
                        <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                            <?php if (isset($link)) { ?>
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
                            <?php if (isset($link)) { ?>
                                <div class="col" style="width:400px;">
                                    <div
                                        style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if (is_int($tweet["id_retweet"])): ?>
                            <div class="container" style="margin-top:5px;padding:20px;">
                                <div class="row" style="align-items:center;">
                                    <form action="./" method="post">
                                        <button type="submit"
                                            style="background-image:url('<?php echo $user_retweet["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                            name="profil">
                                        </button>
                                        <h3 class="col-10">
                                            <?php echo $user_retweet["name"]; ?>
                                        </h3>
                                        <input type="hidden" name="id" value="<?php echo $user_retweet["id_tweet"]; ?>">
                                    </form>
                                    <form action="./" method="post">
                                        <button type="submit" class="btn-link col-2" name="like" style="text-decoration:none;"
                                            value="Like">
                                            <span class="material-symbols-outlined">
                                                favorite
                                            </span>
                                        </button>
                                        <input type="hidden" name="id" value="<?php echo $tweet["id_retweet"]; ?>">
                                    </form>
                                </div>
                                <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                                    <?php if (isset($link)) { ?>
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
                                    <?php if (isset($link)) { ?>
                                        <div class="col" style="width:400px;">
                                            <div
                                                style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
                                            </div>
                                        </div>
                                    <?php } ?>
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

                        $reply = new TweetController();
                        $reply_tweet = $reply->getReply($tweet["id_tweet"]);
                        // var_dump($reply_tweet);
                        foreach ($reply_tweet as $key => $reply_t) {
                            # code...
                
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
                                    $link3 = "https" . $space_arr3[0];
                                    $message_reply = str_replace(" $link3", "", $message_reply);
                                    // echo $message;
                                }
                            }
                            ?>
                            <div class="container" style="margin-top:5px;padding:10px;margin-left:20px;margin-right:20px;">
                                <div class="row" style="align-items:center;">
                                    <form action="./" method="post">
                                        <button type="submit"
                                            style="background-image:url('<?php echo $user_reply["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;"
                                            name="profil">
                                        </button>
                                        <h3 class="col-10">
                                            <?php echo $user_reply["name"]; ?>
                                        </h3>
                                        <input type="hidden" name="id" value="<?php echo $user_reply["id"]; ?>">
                                    </form>
                                    <form action="./" method="post">
                            <button type="submit" class="btn-link col-2" name="like" style="text-decoration:none;" value="Like">
                                <span class="material-symbols-outlined">
                                    favorite
                                </span>
                            </button>
                            <input type="hidden" name="id" value="<?php echo $reply_t["id_tweet"]; ?>">
                </form>
                                </div>
                                <div class="row" style="width:400px;margin:auto;border-bottom:1px solid black;">
                                    <?php if (isset($link)) { ?>
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
                                    <?php if (isset($link)) { ?>
                                        <div class="col" style="width:400px;">
                                            <div
                                                style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                    <?php
                }

                ?>
            <?php elseif ((isset($tweets_hashtag) && isset($_POST["search"])) && !isset($_POST["my_profile"])): ?>
                <?php

                foreach ($tweets_hashtag as $key => $tweet_search) {
                    $user_search = new App\controller\UserController();
                    $user_search = $user_search->getUserInformations($tweet_search["id_user_tweet"]);
                    $avatar = ($user_search["avatar"] != NULL) ? $user_search["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                    $link_array = explode("https", $tweet_search["message_tweet"]);
                    $message = $tweet_search["message_tweet"];
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
                    ?>


                    <div class="container container-fluid " style="width:500px;">
                        <form action="./" method="POST">
                            <div class="row" style="align-items:center;">
                                <div
                                    style="background-image:url('<?php echo $user_search["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;">
                                </div>
                                <h3 class="col-10">
                                    <?php echo $user_search["name"]; ?>
                                </h3>
                            </div>
                            <div class="row">
                                <?php if (isset($link)) { ?>
                                    <div class="col" style="margin-left:20px;width:400px;margin:auto;">
                                        <p class="message">
                                            <?= $message ?>
                                        </p>
                                    </div>
                                <?php } else { ?>
                                    <div class="col" style="margin-left:20px;width:400px;margin:auto;">
                                        <p class="message">
                                            <?php echo $tweet_search["message_tweet"]; ?>
                                        </p>
                                    </div>
                                <?php } ?>
                                <?php if (isset($link)) { ?>
                                    <div class="col" style="width:400px;margin:auto;">
                                        <!-- <img src="" alt="image du tweet"> -->
                                        <div
                                            style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <input type="hidden" name="id_tweet" value="<?php echo $tweet_search["id_tweet"] ?>">
                            <div class="row" style="margin:auto;width:400px;margin:10px;">

                                <input type="text" name="message_reply">
                                <input type="file" id="addPicReply" name="addPicReply">
                                <input type="submit" name="reply" id="reply" value="Répondre">

                            </div>
                            <div class="row" style="margin:auto;width:400px;margin:10px;">
                                <input type="text" name="message_retweet">
                                <input type="file" id="addPicRT" name="addPicRT">
                                <input type="submit" name="retweet" id="retweet" value="Retweeter">
                            </div>
                        </form>
                    </div>



                    <?php
                }
                ?>



            <?php elseif ((isset($user) && !isset($error_not_found)) && !isset($_POST["my_profile"])): ?>
                <div class="container" style="width:500px;">
                    <div class="header">
                        <div class="photo"
                            style="background-image:url('<?php echo $user["banner"]; ?>');background-size:100%;height:200px;width:500px;">
                            <div
                                style="background-repeat:no-repeat;background-image:url('<?php echo $user["avatar"]; ?>');background-size:100% 100%;width:100px;height:100px;border-radius:50%;border:2px solid blue;top:200px;position:absolute;z-index:100;">
                            </div>

                        </div>
                        <div class="info"
                            style="top:300px;position: absolute;text-align: right;justify-content:space-between;">
                            <h1>
                                <?php echo $user["name"]; ?>
                            </h1>
                            <div class="row" style="width:500px;">
                                <p style="margin-right:3%;">
                                    <?php echo "@" . $user["username"]; ?>
                                </p>
                                <p style="margin-right:3%;">
                                    <?php echo $followers; ?><strong> followers </strong>
                                </p>
                                <p style="margin-right:3%;">
                                    <?php echo $followings; ?><strong> following</strong>
                                </p>
                            </div>
                            <div class="content" style="text-align:left;margin-top:3%;font-weight:600;width:500px;">
                                <p>
                                    <?php echo $user["bio"]; ?>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="content" style="text-align:left;margin-top:250px;font-weight:600;">
                        <?php
                        foreach ($tweets_profil as $key => $tweet) {
                            // $user = new App\controller\UserController();
                            // $user = $user->getUserInformations($tweet["id_user_tweet"]);
                            $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                            $link_array = explode("https", $tweet["message_tweet"]);
                            $message = $tweet["message_tweet"];
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
                            ?>

                            <div class="container" style="width:500px;">
                                <form action="./" method="POST">
                                    <div class="row" style="align-items:center;width:500px;">
                                        <div class="col-6">
                                            <div
                                                style="background-repeat:no-repeat;background-image:url('<?php echo $avatar; ?>');background-size:100% 100%;width:100px;height:100px;border-radius:50%;border:2px solid blue;">
                                            </div>
                                        </div>
                                        <div class="col-6">

                                            <h3 class="" style="text-align:right; padding:5px;">
                                                <?php echo $user["name"]; ?>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="row" style="width:500px;margin:auto;">
                                        <?php if (isset($link)) { ?>
                                            <div class="col" style="margin-left:20px;width:400px;">
                                                <p class="message">
                                                    <?= $message ?>
                                                </p>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col">
                                                <p class="message" style="margin-left:20px;width:400px;">
                                                    <?php echo $tweet["message_tweet"]; ?>
                                                </p>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($link)) { ?>
                                            <div class="col" style="width:400px;">
                                                <!-- <img src="" alt="image du tweet" style="width:500px;"> -->
                                                <div
                                                    style="background-image:url('<?= $link ?>');background-size:100%;height:200px;width:500px;border-radius:20px;">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row" style="width:500px;margin:auto;">
                                        <input type="hidden" name="id_tweet" value="<?php echo $tweet["id_tweet"] ?>">
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
                    </div>
                </div>
                <script src="../js/profil.js"></script>
            <?php elseif (isset($_POST["my_profile"])): ?>
                <form action="./" method="post" class="container-fluid" style="width:500px;margin:auto; margin-top:50px;">
                    <div class="row">
                        <label for="email" class="col-6">Url de la photo de couverture</label>
                        <input type="url" name="banner" value="<?php echo $user_update["banner"]; ?>" id="city" required>
                    </div>
                    <div class="row">
                        <label for="email" class="col-6">Url de la photo de profil</label>
                        <input type="url" name="avatar" id="city" value="<?php echo $user_update["avatar"]; ?>" required>
                    </div>
                    <div class="row">
                        <label for="password" class="col-6">Password</label>
                        <input type="password" name="password">
                    </div>
                    <div class="row">
                        <label for="username" class="col-6">Username</label>
                        <input type="text" name="username" value="<?php echo $user_update["username"]; ?>" required><br>
                    </div>
                    <div class="row">
                        <label for="city" class="col-6">City</label>
                        <input type="text" name="city" value="<?php echo $user_update["city"]; ?>" id="city"><br>
                    </div>
                    <div class="row">
                        <label for="bio" class="col-6">Biographie</label>
                        <input type="text" name="bio" value="<?php echo $user_update["bio"]; ?>" id="bio"><br>
                    </div>
                    <div class="row" class="col-12" style="justify-content:flex-end;">
                        <input type="submit" class="btn btn-primary" id="submit_form" name="update_profile"
                            value="Modifier">
                    </div>
                </form>
            <?php else: ?>
                <?php if (isset($error_not_found)): ?>
                    <div class="alert-warning" style="margin-top:20px;">Pas de resultat pour cette recherche ...</div>
                <?php else: ?>
                    <script type="text/javascript">window.onload = function () {
                            document.getElementsByClassName("alert-warning").remove();
                        }</script>
                <?php endif; ?>
            <?php endif; ?>
        </main>
        <?php if (isset($_SESSION["logged_in"])): ?>
            <footer class="col blocks blur logout"
                style="margin-top:10px;z-index:200;background-color:rgb(214, 209, 209);padding:20px;border-radius:20px;">

                <div class="row">
                    <form action="./" method="post">
                        <button type="submit" class="btn-link" name="my_profile" value="<?= $_SESSION["username"]; ?>"
                            style="color:blue;font-weight:600;"><?= $_SESSION["username"]; ?></button>
                    </form>
                </div>
                <div class="row">
                    <form action="./index.php" class="col-6" method="post">
                        <button type="submit" class="btn btn-danger" name="logout">Logout</button>
                    </form>
                    <form action="#" class="col-6">
                        <button type="submit" class="btn btn-blue-twitter" value="Tweeter" id="Tweeter">Tweeter</button>
                    </form>

                </div>
            </footer>
        <?php endif; ?>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- <script src="../public/js/refresh.js"></script> -->
</body>