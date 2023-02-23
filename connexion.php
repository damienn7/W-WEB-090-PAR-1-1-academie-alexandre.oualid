<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"><br>
        <input type="submit" name="submit" id="submit" value="Se connecter">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        include("conn.php");

        // Récupérer l'utilisateur correspondant au nom d'utilisateur
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Vérifier le mot de passe
        if ($row = $stmt->fetch()) {
            $salt = "vive le projet tweet_academy";
            $salted_password = $salt . $password;
            $hashed_password = hash('ripemd160', $salted_password);

            if ($hashed_password === $row["password"]) {
                // Mot de passe correct
                session_start();
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header('Location: /html/index.html');
            } else {
                echo "Mot de passe incorrect";
            }
        } else {
            echo "Nom d'utilisateur incorrect";
        }
    }
    ?>
</body>

</html>