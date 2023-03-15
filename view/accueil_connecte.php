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
                $user = new App\controller\UserController();
                $user = $user->getUserInformations($tweet["id_user_tweet"]);
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
                                <?= $tweet["message_tweet"] ?>
                                <?= "hello world" ?>
                            </p>
                        </div>
                    </div>
                </div>



                <?php
            }

            ?>
        </main>
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
        <?php endif; ?>
    </div>
</body>