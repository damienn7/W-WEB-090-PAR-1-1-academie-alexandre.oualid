<?php

include('connect.php');

// Définissez l'ID de l'utilisateur que vous souhaitez suivre
$id_to_follow = $_POST["id_user_following"]; // Remplacez 1 par l'ID de l'utilisateur que vous souhaitez suivre

// Obtenez l'ID de l'utilisateur actuel à partir de la session ou d'une autre source
$id_current_user = $_SESSION["id"];// Remplacez 2 par l'ID de l'utilisateur actuel

// Insérez une nouvelle ligne dans la table "followers" pour indiquer que l'utilisateur actuel suit l'utilisateur cible
$sql = "INSERT INTO users (id_follower, id_following) VALUES (:id_follower, :id_following)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id_follower' => $id_current_user,
    ':id_following' => $id_to_follow,
]);

// Affichez un message pour indiquer que l'utilisateur a été suivi avec succès
echo "Vous suivez maintenant l'utilisateur avec l'ID $id_to_follow.";

?>
