<?php
// Connexion à la base de données
include('connect.php');

// Affichage des utilisateurs qui suivent l'utilisateur avec l'ID 1
$sql = "SELECT `u`.`username`, `u`.`name`, `u`.`avatar`
        FROM `users` `u`
        JOIN `id_following` `f` ON `u`.`id` = `f`.`id_follower`
        WHERE `f`.`id_following` = :id_utilisateur";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$id_utilisateur = 1; // ID de l'utilisateur pour lequel on souhaite afficher les abonnés
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Affichage des utilisateurs qui suivent l'utilisateur avec l'ID 1
    echo "Utilisateurs qui vous suivent : <br>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Nom d'utilisateur : " . $row["username"] . "<br>";
        echo "Nom complet : " . $row["name"] . "<br>";
        echo "Avatar : " . $row["avatar"] . "<br><br>";
    }
} else {
    echo "Aucun utilisateur ne vous suit pour le moment.";
}

$conn = null;
?>
