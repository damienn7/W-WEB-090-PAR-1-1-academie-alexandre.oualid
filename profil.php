<?php
// Connexion à la base de données
include('connect.php');

// Ajout de l'utilisateur avec l'ID 1 qui suit l'utilisateur avec l'ID 2
$sql1 = "UPDATE `users` SET `id_following`= CONCAT(`id_following`, ',2') WHERE `id`=1";
$sql2 = "UPDATE `users` SET `id_follower`= CONCAT(`id_follower`, ',1') WHERE `id`=2";

if ($conn->query($sql1) && $conn->query($sql2)) {
//   echo "Utilisateur ajouté avec succès";
} else {
  echo "Erreur: " . $conn->error;
}

// Affichage des utilisateurs que suit l'utilisateur avec l'ID 1
$sql3 = "SELECT `id_following` FROM `users` WHERE `id`=1";
$result = $conn->query($sql3);

if ($result->rowCount() > 0) {
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $following_id = explode(",", $row["id_following"]);
  }
  if ($following_id [0]!=''){
  // Jointure avec la table users pour obtenir les noms d'utilisateurs
  $sql4 = "SELECT `name` FROM `users` WHERE `id` IN (" . implode(",", $following_id) . ")";

  $result2 = $conn->query($sql4);
  if ($result2->rowCount() > 0) {
    echo "Utilisateurs suivis par l'utilisateur avec l'ID 1 : ";
    while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
      echo $row2["name"] . ", ";
    }
  } else {
    echo "Aucun utilisateur suivi";
  }
} else {
  echo "Aucun utilisateur suivi";
}

$conn = null;}
?>