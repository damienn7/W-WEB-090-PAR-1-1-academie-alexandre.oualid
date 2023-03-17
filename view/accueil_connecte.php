<!-- <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Twitter - Accueil</title>
            <link rel="stylesheet" href="../public/css/main.css">
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
            <script src="./js/script.js" type="text/javascript"></script>

        </head> -->

<body class="container container-fluid">
    <div class="row container-fluid">

        <?php include("../view/header.php"); ?>
        <main class="col-4 middle blur">
            <h2 style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">Accueil</h2>
            <?php if ($alert_success != "") : ?>
                <div class="row">
                    <div class="col">
                        <p class="alert-success">
                            <?= $alert_success ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($alert_danger != "") : ?>
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
                $user = new App\controller\UserController();
                $user = $user->getUserInformations($tweet["id_user_tweet"]);
                // Remplacer les mentions par des liens
                $tweet = preg_replace('/@(\w+)/', '<a href="http://localhost:2000/public/index.php">@$1</a>', $tweet);

                // Remplacer les hashtags par des liens
                $tweet = preg_replace('/#(\w+)/', '<a href="http://localhost:2000/public/index.php">#$1</a>', $tweet);

                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
            ?>

                <div class="container container-fluid ">
                    <form action="./" method="POST">
                        <div class="row" style="align-items:center;">
                            <img src="<?php echo $avatar; ?>" class="col" alt="profile image" style="width:40px;height:auto;padding:10px;border-radius:50%;">
                            <h3 class="col-10">
                                <?php echo $user["name"]; ?>
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="message">
                                    <?= $tweet["message_tweet"] ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="id_tweet" value="<?php echo $tweet["id_tweet"] ?>">
                            <div class="col">
                                <input type="text" name="message_reply">
                                <input type="submit" name="reply" id="reply" value="Répondre">
                            </div>
                            <div class="col">
                                <input type="text" name="message_retweet">
                                <input type="submit" name="retweet" id="retweet" value="Retweeter">
                            </div>
                        </div>
                    </form>
                </div>



            <?php
            }

            ?>
        </main>
        <?php if (isset($_SESSION["logged_in"])) : ?>
            <footer class="col blocks blur logout">

                <div class="row">
                    <a href="#" class="moncompte img-icon"><?= $_SESSION["username"]; ?></a>
                </div>
                <div class="row">
                    <form action="./index.php" class="col" method="post">
                        <button type="submit" class="btn btn-danger" name="logout" class="moncompte img-icon">Logout</button>
                    </form>
                    <form action="#" class="col">
                        <input type="submit" class="btn btn-blue-twitter" value="Tweeter" id="Tweeter">
                    </form>

                </div>
            </footer>
        <?php endif; ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- <script src="../public/js/refresh.js"></script> -->
</body>