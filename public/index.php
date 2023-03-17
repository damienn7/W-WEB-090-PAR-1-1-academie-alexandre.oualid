<?php
use App\Controller\MessageController;

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\controller\TweetController;
use App\controller\IndexController;
use App\controller\UserController;
use App\model\AutoloaderModel;

require_once '../model/AutoloaderModel.php';
require_once '../controller/IndexController.php';
require_once '../controller/TweetController.php';
require_once '../model/TweetModel.php';
require_once '../model/UserModel.php';
require_once '../model/DatabaseModel.php';
require_once '../model/ConfigDbModel.php';
require_once '../controller/UserController.php';
require_once '../controller/MessageController.php';
require_once '../view/body.php';

AutoloaderModel::register();

if (!isset($_SESSION["logged_in"])) {
    if (isset($_POST["submit_account"])) {
        $user = new UserController();
        $user->createUser($_POST);
    }

    if (isset($_POST["username"])) {
        $user_connect = new UserController();
        $resp = $user_connect->connectUser($_POST["username"], $_POST["password"]);
        if (!isset($_SESSION["logged_in"])) {
            header("Location: index.php");
        }
    }
}

if (isset($_SESSION["logged_in"])) {

    if (isset($_POST["tweet"])) {
        $tweet = new TweetController();
        $tweet->createTweet($_SESSION['id'], htmlspecialchars($_POST["tweet"]));
    }

    if (isset($_POST["logout"])) {
        unset($_SESSION["logged_in"]);
        unset($_SESSION["id"]);
        unset($_SESSION["username"]);
        session_destroy();
        header("Refresh:0");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["retweet"])) {
        $retweet = $_POST["message_retweet"];
        $id = $_SESSION["id"];
        $id_retweet = $_POST["id_tweet"];
        $addPicRT = $_POST["addPicRT"];

        $b = new TweetController();
        $b->createRetweet($id, $retweet, $id_retweet, $addPicRT);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reply"])) {
        $reply = $_POST["message_reply"];
        $id = $_SESSION["id"];
        $id_reply = $_POST["id_tweet"];
        $addPicRT = $_POST["addPicReply"];

        $b = new TweetController();
        $b->createreply($id, $reply, $id_reply, $addPicRT);
    }

    //potentiellement a refaire
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["follow"])) {
        $id_following = $_POST["id"];
        $id_follower = $_SESSION["id"];

        $f = new UserController();
        $f->followUser($id_following,$id_follower);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["envoyer"])) {
        if (isset($_POST["mp"])) {
            $id_user = $_SESSION["id"];
            $id_receiver = 9; //IL FAUT changer ça j'ai mis 9 pour test mais il faudra récupérer un id différent selon le receiver
            $mp = $_POST["mp"];

            $e = new MessageController();
            $e->createMessage($id_user, $id_receiver, $mp);
        } else {
            echo "Vous devez écrire un message.";
        }
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        if ($search == "") {
            $tweet = new TweetController();
            $tweets = $tweet->searchByHashtag($search);
        } else {

            if ($search[0] === '#') { // Vérification si le premier caractère est un hashtag
                $tweet = new TweetController();
                $tweets = $tweet->searchByHashtag($search);
                // Traiter les résultats de la recherche des tweets
            } else {
                $user = new UserController();
                $result = $user->search($search);
                // Traiter les résultats de la recherche des profils utilisateur
            }
            # code...
        }
    }
}



// Formulaire de recherche
//   echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
//   echo "<input type=\"text\" name=\"search\">";
//   echo "<input type=\"submit\" value=\"Rechercher\">";
//   echo "</form>";

//   $conn = null;


$home = new IndexController();
if (!isset($_SESSION["logged_in"])) {
    $home->renderHomeView();
} else {
    if (isset($_POST['search'])) {
        if (isset($tweets)) {
            # code...
            $home->renderTweetsSearch($tweets);
        }
        if (isset($result)) {
            # code...
            $home->renderHomeProfilConnected($result);
        }
    } else {
        $home->renderHomeViewConnected("", "", "<form action=\"./\" method=\"POST\">
                <input type=\"text\" style='padding: 4px;' maxlength=\"140\" name=\"tweet\" id=\"tweet\" autocomplete=\"off\">
                <input type=\"submit\" value=\"Tweeter\" class='btn btn-blue-twitter' id=\"Tweeter\" name=\"submit_tweet\">
                </form>");
    }

}




?>