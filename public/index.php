<?php
use App\Controller\LikeController;
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
require_once '../controller/LikeController.php';
require_once '../model/LikeModel.php';
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
        // header("Refresh:0");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["retweet"])) {
        $retweet = $_POST["message_retweet"];
        $id = $_SESSION["id"];
        $id_retweet = $_POST["id_retweet"];

        $b = new TweetController();
        $b->createRetweet($id, $retweet, $id_retweet);
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reply"])) {
        $reply = $_POST["message_reply"];
        $id = $_SESSION["id"];
        $id_reply = $_POST["id_tweet"];

        $b = new TweetController();
        $b->createReply($id, $reply, $id_reply);
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

    $result = "";
    $tweets = "";
    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        if ($search === "") {
            $tweet = new TweetController();
            $tweets = $tweet->searchByHashtag($search);
        } else {

            if ($search[0] === '#') { // Vérification si le premier caractère est un hashtag
                $tweet = new TweetController();
                $tweets = $tweet->searchByHashtag($search);
                // Traiter les résultats de la recherche des tweets
                // var_dump($tweets);
            } elseif ($search[0] === '@') {
                $tweet = new TweetController();
                $tweets = $tweet->searchByHashtag($search);
            } else {

                $user = new UserController();
                $result = $user->search($search);

                if ($result === false) {
                    $tweet = new TweetController();
                    $tweets = $tweet->searchByHashtag($search);
                }


                // Traiter les résultats de la recherche des profils utilisateur
            }
            # code...
        }
    }

    if (isset($_POST["my_profile"])) {
        $user = new UserController();
        $user_update = $user->search($_POST["my_profile"]);
    }

    if (isset($_POST["update_profile"])) {
        $user = new UserController();
        $user->updateProfil($_POST);
    }

    if (isset($_POST["profil"])) {
        $user = new UserController();
        $result = $user->getUserInformations($_POST["id"]);
    }

    if (isset($_POST["like"])) {
        $like = new LikeController();
        $like->setLike($_POST["id"],$_SESSION["id"]);
    }

    if (isset($_POST["unlike"])) {
        $like = new LikeController();
        $like->deleteLike($_POST["id"],$_SESSION["id"]);
    }
    $new_following=[];

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["follow"])) {
        $id_following = $_POST["id_following"];
        $id_follower = $_SESSION["id"];
        $new_following = $_POST["following-list"];
        $new_follower = $_POST["followers_list"];
        $f = new UserController();
        $f->followUser($id_following,$id_follower,$new_following,$new_follower);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["unfollow"])) {
        $id_following = $_POST["id_following"];
        $id_follower = $_SESSION["id"];
        $new_following = $_POST["following-list"];
        $new_follower = $_POST["followers_list"];
        $f = new UserController();
        $f->unfollowUser($id_following,$id_follower,$new_following,$new_follower);
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
        if (isset($result)) {
            if (is_array($result)) {
                $state_error = false;
                $home->renderHomeProfilConnected($result, $state_error);
            }

        }

        if (isset($tweets)) {
            if (is_array($tweets)) {
                $home->renderTweetsSearch($tweets);
                $state_error = true;
            }
        }
    } elseif(isset($_POST["my_profile"])){
        $home->renderUpdateProfil($user_update);
    }else{
        $home->renderHomeViewConnected("", "", "<form action=\"./\" method=\"POST\"  style=\"margin:20px;\">
                <input type=\"text\" maxlength=\"140\" name=\"tweet\" id=\"tweet\" autocomplete=\"off\" style=\"margin:20px;padding:5px;border-radius:20px;border:2px solid #1da1f3;background-color:rgb(214, 209, 209);\">
                <input type=\"submit\" value=\"Tweeter\" class='btn btn-blue-twitter' id=\"Tweeter\" name=\"submit_tweet\">
                </form>");
    }

}




?>