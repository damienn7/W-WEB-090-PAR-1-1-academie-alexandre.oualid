<?php
//code Pour afficher les abonnements 
include('connect.php');

// Obtenez l'ID de l'utilisateur dont vous souhaitez afficher les abonnements
$id_user = $_POST["id_user_following"]; // Remplacez 1 par l'ID de l'utilisateur dont vous souhaitez afficher les abonnements

// Sélectionnez tous les utilisateurs que l'utilisateur cible suit
$sql = "SELECT * FROM users WHERE id IN (SELECT id_following FROM users WHERE id_follower = :id_user)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id_user' => $id_user,
]);
$following = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichez les utilisateurs que l'utilisateur cible suit
echo "<h1>Abonnements de l'utilisateur avec l'ID $id_user :</h1>";
foreach ($following as $user) {
    echo "<p>Nom d'utilisateur : " . $user['username'] . "</p>";
    echo "<p>Nom complet : " . $user['name'] . "</p>";
    // Ajoutez d'autres informations utilisateur si nécessaire
}

?>
