<body class="container container-fluid">
    <div class="row container-fluid">

        <?php include("../view/header.php"); ?>
        <main class="col-6 middle blur">
            <div  style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;z-index:101;">
            <!-- <h2>Accueil</h2> -->
            <form action="index.php" method="post">
  <label for="search">Rechercher :</label>
  <input type="text" name="search" id="search">
  <input type="submit" value="Rechercher">
</form>
</div>

            <?php if (!isset($_POST["search"])): ?>

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
                $link_array=explode("https",$tweet["message_tweet"]);
                $message=$tweet["message_tweet"];
                if (isset($link_array[1])) {
                    $link = "https". $link_array[1];
                    $message=str_replace(" $link","",$message);
                }
                ?>

                <div class="container container-fluid ">
                <form action="./" method="POST">
                    <div class="row" style="align-items:center;">
                        <img src="<?php echo $avatar; ?>" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;">
                        <h3 class="col-10">
                            <?php echo $user["name"]; ?>
                        </h3>
                    </div>
                    <div class="row">
                    <?php if(isset($link)){?>
                        <div class="col">
                            <p class="message">
                                <?= $message ?>
                            </p>
                        </div>
                        <?php }else{?>
                            <p class="message">
                            <?php echo $tweet["message_tweet"];}?>
                            </p>
                            <?php if(isset($link)){?>
                        <div class="col">
                            <img src="<?= $link;?>" alt="image du tweet">
                            </div>
                        <?php }?>
                    </div>
                    <div class="row">
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
            <?php elseif(isset($tweets_hashtag)): ?>
                <?php
            foreach ($tweets_hashtag as $key => $tweet_search) {
                $user_search = new App\controller\UserController();
                $user_search = $user_search->getUserInformations($tweet_search["id_user_tweet"]);
                $avatar = ($user_search["avatar"] != NULL) ? $user_search["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                $link_array=explode("https",$tweet_search["message_tweet"]);
                $message=$tweet_search["message_tweet"];
                if (isset($link_array[1])) {
                    $space_arr=explode(" ",$link_array[1]);
                    if (!isset($space_arr[1])) {
                        # code...
                        $link = "https". $link_array[1];
                        $message=str_replace(" $link","",$message);
                        echo $message;
                    }else{
                        $link = "https". $space_arr[0];
                        $message=str_replace(" $link","",$message);
                        echo $message;
                    }
                }
                ?>

                <div class="container container-fluid ">
                <form action="./" method="POST">
                    <div class="row" style="align-items:center;">
                        <img src="<?php echo $avatar; ?>" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;">
                        <h3 class="col-10">
                            <?php echo $user_search["name"]; ?>
                        </h3>
                    </div>
                    <div class="row">
                    <?php if(isset($link)){?>
                        <div class="col">
                            <p class="message">
                                <?= $message ?>
                            </p>
                        </div>
                        <?php }else{?>
                            <p class="message">
                            <?php echo $tweet_search["message_tweet"];}?>
                            </p>
                            <?php if(isset($link)){?>
                        <div class="col" style="width:400px;">
                            <!-- <img src="" alt="image du tweet"> -->
                            <div style="background-image:url('<?= $link;?>');background-size:100%;height:200px;width:500px;border-radius:15px;">
                            </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="row">
                            <input type="hidden" name="id_tweet" value="<?php echo $tweet_search["id_tweet"] ?>">
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
            <?php else: ?>
    <div class="container">
		<div class="header">
			<div class="photo" style="background-image:url('<?php echo $user["banner"]; ?>');background-size:100%;height:200px;width:500px;">
				<div style="background-repeat:no-repeat;background-image:url('<?php echo $user["avatar"];?>');background-size:100% 100%;width:100px;height:100px;border-radius:50%;border:2px solid blue;top:200px;position:absolute;z-index:100;">
            </div>
                
			</div>
			<div class="info" style="top:300px;position: absolute;text-align: right;justify-content:space-between;">
				<h1><?php echo $user["name"];?></h1>
                <div class="row" style="width:500px;">
				<p style="margin-right:3%;"><?php echo "@".$user["username"];?></p>
				<p style="margin-right:3%;"><?php echo $followers;?><strong>  followers </strong> </p>
				<p style="margin-right:3%;"><?php echo $followings;?><strong>  following</strong> </p>
            </div>
            <div class="content" style="text-align:left;margin-top:3%;font-weight:600;">
			<p><?php echo $user["bio"];?></p>
			
            </div>
            <div class="content" style="text-align:left;margin-top:3%;font-weight:600;">
            <?php
            foreach ($tweets_profil as $key => $tweet) {
                // $user = new App\controller\UserController();
                // $user = $user->getUserInformations($tweet["id_user_tweet"]);
                $avatar = ($user["avatar"] != NULL) ? $user["avatar"] : "https://cdn.discordapp.com/attachments/1077191464683048980/1080782875521204274/sans_pp.webp";
                $link_array=explode("https",$tweet["message_tweet"]);
                $message=$tweet["message_tweet"];
                if (isset($link_array[1])) {
                    $link = "https". $link_array[1];
                    $message=str_replace(" $link","",$message);
                }
                ?>

                <div class="container" style="width:500px;">
                <form action="./" method="POST">
                    <div class="row" style="align-items:center;">
                        <!-- <img src="" class="col" alt="profile image"
                            style="width:40px;height:auto;padding:10px;border-radius:50%;"> -->
                            <div class="col-6">

                                <div style="background-repeat:no-repeat;background-image:url('<?php echo $avatar;?>');background-size:100% 100%;width:100px;height:100px;border-radius:50%;border:2px solid blue;">
            </div>
                            </div>
                            <div class="col-6">
                                
                                <h3 class="" style="text-align:right; padding:5px;">
                                    <?php echo $user["name"]; ?>
                                </h3>
                                </div>
                    </div>
                    <div class="row" style="width:500px;">
                    <?php if(isset($link)){?>
                        <div class="col">
                            <p class="message">
                                <?= $message ?>
                            </p>
                        </div>
                        <?php }else{?>
                            <p class="message">
                            <?php echo $tweet["message_tweet"];}?>
                            </p>
                            <?php if(isset($link)){?>
                        <div class="col">
                            <!-- <img src="" alt="image du tweet" style="width:500px;"> -->
                            <div style="background-image:url('<?=$link?>');background-size:100%;height:200px;width:500px;border-radius:20px;">
                            </div>
                        <?php }?>
                    </div>
                    <div class="row">
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
	</div>

	</div>
	<script src="../js/profil.js"></script>
            <?php endif; ?>
        </main>
        <?php if (isset($_SESSION["logged_in"])): ?>
            <footer class="col blocks blur logout">

                <div class="row">
                    <a href="#" class="moncompte img-icon" style="margin-top:10px;"><?= $_SESSION["username"]; ?></a>
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
    <?php if(isset($_POST["search"])): ?>
        <script src="profil.js"></script>
    <?php endif; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- <script src="../public/js/refresh.js"></script> -->
</body>