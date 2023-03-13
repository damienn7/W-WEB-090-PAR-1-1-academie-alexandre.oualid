<?php
//code Pour afficher les abonnés
include('connect.php');
// Obtenez l'ID de l'utilisateur dont vous souhaitez afficher les abonnés
$id_user = $_POST["id_user_follower"]; // Remplacez 1 par l'ID de l'utilisateur dont vous souhaitez afficher les abonnés

// Sélectionnez tous les utilisateurs qui suivent l'utilisateur cible
$sql = "SELECT * FROM users WHERE id IN (SELECT id_follower FROM users WHERE id_following = :id_user)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id_user' => $id_user,
]);
$followers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichez les utilisateurs qui suivent l'utilisateur cible
echo "<h1>Abonnés de l'utilisateur avec l'ID $id_user :</h1>";
foreach ($followers as $user) {
    echo "<p>Nom d'utilisateur : " . $user['username'] . "</p>";
    echo "<p>Nom complet : " . $user['name'] . "</p>";
    // Ajoutez d'autres informations utilisateur si nécessaire
}

?>
