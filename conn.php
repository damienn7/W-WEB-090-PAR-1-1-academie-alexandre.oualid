<?php
try{
    $user = "wac209_user";
    $mdp = "wac209";
    $conn = new PDO("mysql:host=www.webacademie-project.tech;dbname=twitter_academy_db", $user, $mdp);
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}
?>