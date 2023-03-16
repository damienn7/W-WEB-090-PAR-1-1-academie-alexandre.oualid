<?php
// Connexion à la base de données
include('connect.php');

if(isset($_POST['search'])){
  // Récupération de la valeur de recherche
  $search = $_POST['search'];

  // Requête SQL pour chercher les profils correspondants
  $sql = "SELECT * FROM `users` WHERE `username` LIKE '%$search%' OR `name` LIKE '%$search%'";

  $result = $conn->query($sql);

  if ($result->rowCount() > 0) {
    echo "Résultats de recherche pour \"$search\":<br>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<a href=\"profil.php?id=" . $row["id"] . "\">" . $row["username"] . "</a><br>";
    }
  } else {
    echo "Aucun résultat de recherche pour \"$search\"";
  }
}

// Formulaire de recherche
echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
echo "<input type=\"text\" name=\"search\">";
echo "<input type=\"submit\" value=\"Rechercher\">";
echo "</form>";

$conn = null;
