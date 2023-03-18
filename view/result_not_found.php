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

                <div class="alert-warning" style="margin-top:20px;">Pas de resultat pour cette recherche ...</div>
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