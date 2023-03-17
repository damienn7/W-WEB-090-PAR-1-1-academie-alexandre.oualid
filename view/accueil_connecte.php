<body class="container container-fluid">
    <div class="row container-fluid">

        <?php include("../view/header.php"); ?>
        <main class="col-6 middle blur">
            <div  style="position:fixed;top:0;background-color:white;width:100%;padding:0.5rem;">
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
            <?php else: ?>
                <div class="container">
		<div class="header">
			<div class="photo" style="background-image:url('<?php echo $user["banner"]; ?>');background-size:100%;height:200px;width:500px;">
				<img src="<?php echo $user["avatar"];?>" style="width:100px;height:100px;border-radius:50%;border:2px solid blue;top:200px;position:absolute;">
                
			</div>
			<div class="info" style="top:300px;position: absolute;text-align: right;justify-content:space-between;">
				<h1><?php echo $user["name"];?></h1>
                <div class="row" style="width:500px;">
				<p style="margin-right:3%;"><?php echo "@".$user["username"];?></p>
				<p style="margin-right:3%;"><strong>Followers: </strong> <?php echo $followers;?></p>
				<p style="margin-right:3%;"><strong>Following: </strong> <?php echo $followings;?></p>
            </div>
			</div>
		</div>
		<div class="content">
			<p><?php echo $user["bio"];?></p>
			
		</div>
	</div>
	<script src="../js/profil.js"></script>
            <?php endif; ?>
        </main>
        <?php if (isset($_SESSION["logged_in"])): ?>
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
    <?php if(isset($_POST["search"])): ?>
        <script src="profil.js"></script>
    <?php endif; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- <script src="../public/js/refresh.js"></script> -->
</body>