<?php
session_start();
include 'connect.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

// Récupérer les informations de l'utilisateur à partir de la base de données
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Récupérer les utilisateurs que l'utilisateur suit à partir de la base de données
$sql = "SELECT users.id, users.username, users.email FROM users INNER JOIN user_follows ON users.id = user_follows.id_following WHERE user_follows.id_follower = $user_id";
$result = mysqli_query($conn, $sql);

// Afficher la liste des utilisateurs suivis
echo "<h1>Abonnements de " . $user['username'] . "</h1>";
while ($following_user = mysqli_fetch_assoc($result)) {
  echo "<p><a href='profile.php?id=" . $following_user['id'] . "&username=" . $following_user['username'] . "'>" . $following_user['username'] . "</a></p>";
}