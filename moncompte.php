<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Compte</title>
</head>
<body>
<header>
    <div class="menu">
        <a href="">Inscrivez-vous</a>
        <a href="login.php" id="con">Connectez-vous</a>
        <h1>Mon Compte</h1>
        <a href="accueil.php">Accueil</a>
        <a href="">Déconnexion</a>
    </div>
</header>
<main>
    <div class="infos">
        <?php
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        include('profil.php');
        // Connectez-vous à la base de données
        include("connect.php");

        $user_id = $_SESSION['id'];

        if (isset($user_id)) {

            $stmt = $conn->prepare("SELECT name, username, register_date, bio, avatar FROM users WHERE id = :id");
            $stmt->bindParam(':id', $user_id);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Afficher les informations de l'utilisateur
            echo "<h2>Bienvenue, " . $user['name'] . "!</h2>";
            echo "<p>Nom d'utilisateur : " . $user['username'] . "</p>";
            echo "<p>Date d'inscription : " . $user['register_date'] . "</p>";
            echo "<p>Biographie : " . $user['bio'] . "</p>";
            echo "<img src='" . $user['avatar'] . "' alt='Avatar'>";
            echo "<form method='post'>";
            echo "<input type='submit' name='delete_account' value='Supprimer le compte'>";
            echo "</form>";
        } else {
            echo "ERREUR TOUS AUX ABRIS !!!";
        }

        if (isset($_POST['delete_account'])) {
            // Préparer la requête SQL pour supprimer l'utilisateur
            $delete = $conn->prepare("DELETE FROM users WHERE id = :id");

            // Lier les valeurs à la requête préparée
            $delete->bindValue(':id', $user_id);

            // Exécuter la requête
            $delete->execute();

            // Supprimer la variable de session
            unset($_SESSION['id']);

            // Rediriger l'utilisateur vers la page de connexion
            header('Location: profile2.php');
            exit;
        }
        ?>
    </div>
        <script src="./profil.js"></script>
</main>
</body>
</html>
