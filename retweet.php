<?php
session_start();//reprend la session ouverte
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {


    $retweet = $_POST["retweet"];
    $id = $_SESSION["id"];

    include("conn.php");

    try{
        $sql = "INSERT INTO tweet (id_user, message, id_retweet)  VALUES (:id_user,:message,:id_retweet)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':retweet', $tweet,PDO::PARAM_STR_CHAR);
        $stmt->bindParam(':id', $id,PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo "Une erreur est survenue veuillez remplir le formulaire correctement.";
        die('Erreur : ' . $e->getMessage());
    }
}
?>
