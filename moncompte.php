<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" href=""><title>Compte</title></head><body><header><div class="menu"><a href="">Inscrivez-vous</a><a href="login.php" id="con">Connectez-vous</a><h1>Mon Compte</h1><a href="accueil.php">Accueil</a><a href="">Déconnexion</a></div></header><main><div class="infos"><?php
            session_start();
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Connectez-vous à la base de données
            include("connect.php");

            $user_email = $_SESSION['id'];

            if (isset($user_email)) {

                $stmt = $conn->prepare("SELECT name,username,register_date,bio,avatar FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id_user);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "ERREUR TOUS AUX ABRIS !!!";
            }
            if (isset($_POST['delete_account'])) {
                // Préparer la requête SQL pour supprimer l'utilisateur
                $delete = $conn->prepare("DELETE FROM users WHERE id = :id");

                // Lier les valeurs à la requête préparée
                $delete->bindValue(':id', $_SESSION['id']);

                // Exécuter la requête
                $delete->execute();

                // Supprimer la variable de session
                unset($_SESSION['id']);

                // Rediriger l'utilisateur vers la page de connexion
                header('Location: login.php');
                exit;
            }
            ?>