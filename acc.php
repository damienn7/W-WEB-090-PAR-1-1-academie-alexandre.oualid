<?php
session_start();//reprend la session ouverte
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $tweet = $_POST["tweet"];
    $id = $_SESSION["id"];

    include("conn.php");

    try{
        $sql = "INSERT INTO tweet(id_user,message) VALUES (:id,:tweet)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':tweet', $tweet,PDO::PARAM_STR_CHAR);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Une erreur est survenue veuillez remplir le formulaire correctement.";
        die('Erreur : ' . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" maxlength="140" name="tweet" id="tweet" autocomplete="off">
        <input type="submit" value="Tweeter" id="Tweeter" name="submit">
    </form>
</body>

</html>