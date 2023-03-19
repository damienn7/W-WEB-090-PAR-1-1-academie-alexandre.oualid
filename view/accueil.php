<body class="container container-fluid">

    <div class="row container-fluid">
        <?php include("../view/header.php"); ?>

        <main class="col-4 middle blur logout" style="margin-left:20%;">
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
                $user = new App\controller\UserController();
                $user = $user->getUserInformations($tweet["id_user_tweet"]);
                // $avatar = (($user["avatar"] !== NULL||$user["avatar"] != "NULL") || ($user["avatar"] !== "" ||!empty($avatar))) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                $message = $tweet["message_tweet"];
                if ($tweet["message_tweet"] != "") {
                    # code...
            
                    $link_array = explode("https", $tweet["message_tweet"]);
                    if (isset($link_array[1])) {


                        $space_arr = explode(" ", $link_array[1]);
                        if (!isset($space_arr[1])) {
                            # code...
                            $link = "https" . $link_array[1];
                            if ($message != "") {
                                # code...
                                $message = str_replace(" $link", "", $message);
                            } else {

                            }
                            // echo $message;
                        } else {
                            $link = "https" . $space_arr[0];
                            $message = str_replace(" $link", "", $message);
                            // echo $message;
                        }
                    }
                }
                ?>

                <div class="container container-fluid " style="margin:20px;">
                    <div class="row" style="align-items:center;width:500px;margin:auto;">
                        <!-- <img src="<?php //echo $avatar; ?>" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;"> -->
                        <div
                            style="background-image:url('<?php echo $user["avatar"]; ?>');background-size:100% 100%;background-repeat:no-repeat;width:50px;height:50px;border-radius:50%;z-index:100;margin-right:10px;margin-bottom:5px;">
                        </div>
                        <h3 class="col-10">
                            <?php echo $user["name"] ?>
                        </h3>
                    </div>
                    <div class="row" style="width:500px;margin:auto;">
                        <?php if (isset($link)) { ?>
                            <div class="col">
                                <p class="message">
                                    <?= $message ?>
                                </p>
                            </div>
                        <?php } else { ?>
                            <div class="col">
                                <p class="message">
                                    <?php echo $tweet["message_tweet"]; ?>
                                </p>
                            </div>
                        <?php } ?>

                    </div>
                    <?php if (isset($link)) { ?>
                        <div class="col" style="width:500px;margin:auto;">
                            <div
                                style="background-image:url('<?= $link; ?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
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


                        <div class="modal-body" style="padding:40px;">
                            <div class="row">
                                <label for="email" class="col-2">Email</label>
                                <input autocomplete="off" class="col-6" type="email" name="email" id="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="row">
                                <label for="password" class="col-2">Password</label>
                                <input type="password" name="password" class="col-6" required minlength="8" maxlength="15"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                            </div>

                            <div class="row">
                                <label for="name" class="col-2">Firstname Lastname</label>
                                <input type="text" class="col-6" name="name" required>
                            </div>

                            <div class="row">
                                <label for="username" class="col-2">Username</label>
                                <input type="text" class="col-6" name="username" required>
                            </div>
                            <div class="row">
                                <label for="birthdate" class="col-2">Birthdate</label>
                                <input type="date" class="col-6" name="birthdate" required>
                            </div>
                            <div class="row">

                                <label for="gender" class="col-2">Gender</label>
                                <select name="gender" id="gender" class="col-6" required>
                                    <option value="Autre">Autre</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="row">
                                <label for="city" class="col-2">City</label>
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
                                <label for="username" class="col-2">Username</label>
                                <input type="text" name="username" class="col-6" id="username" required>
                            </div>
                            <div class="row">
                                <label for="password" class="col-2">Password</label>
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