<?php
session_start();
include 'connect.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

// Récupérer la chaîne de recherche à partir de l'URL
$search_string = $_GET['q'];

// Rechercher les utilisateurs correspondants dans la base de données
$sql = "SELECT * FROM users WHERE username LIKE '%$search_string%'";
$result = mysqli_query($conn, $sql);

// Afficher les résultats de recherche
echo "<h1>Résultats de recherche pour '$search_string'</h1>";
while ($user = mysqli_fetch_assoc($result)) {
  echo "<p><a href='profile.php?id=" . $user['id'] . "&username=" . $user['username'] . "'>" . $user['username'] . "</a></p>";
}
