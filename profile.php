<?php
include(-'connect.php');
// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des informations du profil de l'utilisateur
$user_id = $_GET['id']; // ID de l'utilisateur passé dans l'URL
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

// Affichage des informations du profil de l'utilisateur
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Nom d'utilisateur : " . $row["username"] . "<br>";
    echo "Adresse e-mail : " . $row["email"] . "<br>";
    echo "Date d'inscription : " . $row["register_date"] . "<br>";
} else {
    echo "Aucun utilisateur trouvé avec cet identifiant.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
