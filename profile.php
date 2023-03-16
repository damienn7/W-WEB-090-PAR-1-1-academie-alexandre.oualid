<?php
// Connexion à la base de données
include('connect.php');

// Récupération de l'ID de l'utilisateur dont on veut afficher le profil
$user_id = $_GET['user_id'];

// Requête pour extraire les informations de profil de l'utilisateur avec l'ID spécifié
$sql = "SELECT * FROM `users` WHERE `id`=$user_id";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
  $row = $result->fetch(PDO::FETCH_ASSOC);
  // Extraction des informations de profil
  $name = $row['name'];
  $username = $row['username'];
  $bio = $row['bio'];
  $avatar = $row['avatar'];

  // Affichage des informations de profil
  echo "<h1>$name</h1>";
  echo "<img src='$avatar' alt='$name' width='100' height='100'>";
  echo "<p><strong>Nom d'utilisateur:</strong> $username</p>";
  echo "<p><strong>Biographie:</strong> $bio</p>";
} else {
  echo "Utilisateur introuvable";
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
