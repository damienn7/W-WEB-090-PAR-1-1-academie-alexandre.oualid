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

// Vérifier si l'utilisateur suit déjà cette personne
$following_id = $_GET['id'];
$sql = "SELECT * FROM user_follows WHERE id_follower = $user_id AND id_following = $following_id";
$result = mysqli_query($conn, $sql);
$already_following = mysqli_num_rows($result) > 0;

// Si l'utilisateur a cliqué sur le bouton Suivre/Déjà suivi, mettre à jour la base de données
if (isset($_POST['follow'])) {
  if (!$already_following) {
    $sql = "INSERT INTO user_follows (id_follower, id_following) VALUES ($user_id, $following_id)";
    mysqli_query($conn, $sql);
    $sql = "UPDATE users SET following_count = following_count + 1 WHERE id = $user_id";
    mysqli_query($conn, $sql);
    $sql = "UPDATE users SET followers_count = followers_count + 1 WHERE id = $following_id";
    mysqli_query($conn, $sql);
  }
  else {
    $sql = "DELETE FROM user_follows WHERE id_follower = $user_id AND id_following = $following_id";
    mysqli_query($conn, $sql);
    $sql = "UPDATE users SET following_count = following_count - 1 WHERE id = $user_id";
    mysqli_query($conn, $sql);
    $sql = "UPDATE users SET followers_count = followers_count - 1 WHERE id = $following_id";
    mysqli_query($conn, $sql);
  }
  // Recharger la page pour afficher le nouvel état de suivi
  header('Location: profile.php?id=' . $following_id);
  exit();
}

// Afficher les informations de l'utilisateur visité et le bouton Suivre/Déjà suivi
$following_username = $_GET['username'];
echo "<h1>Profil de $following_username</h1>";
echo "<p>Email: " . $user['email'] . "</p>";
echo "<p>Nombre d'abonnés: " . $user['followers_count'] . "</p>";
echo "<p>Nombre de personnes suivies: " . $user['following_count'] . "</p>";
  if (!$already_following) {
    echo "<form method='post'><button type='submit' name='follow'>Suivre</button></form>";
  }
  else {
    echo "<form method='post'><button type='submit' name='follow'>Déjà suivi</button></form>";
  }
  