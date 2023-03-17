<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP</title>
</head>

<body>
    <header>
        <form action="" method="POST">
            <label for="mp">MP</label>
            <input type="text" name="mp" id="mp">
            <input type="submit" name="envoyer" value="envoyer">
        </form>
    </header>
    <main>
        <?php
        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $id_user = $_SESSION["id"];
        $id_receiver = 9;
        $mp = $_POST["mp"];

        include("conn.php");

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["envoyer"])) {
            if (isset($_POST["mp"])) {
                try {
                    $sql = "INSERT INTO private_message (id_sender, id_receiver, message) VALUES (:id_user, :id_receiver, :mp)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":id_user", $id_user, \PDO::PARAM_INT);
                    $stmt->bindParam(":id_receiver", $id_receiver, \PDO::PARAM_INT);
                    $stmt->bindParam(":mp", $mp, \PDO::PARAM_STR_CHAR);
                    $stmt->execute();
                } catch (\Exception $e) {
                    echo "Une erreur est survenue";
                    die('Erreur : ' . $e->getMessage());
                }
            }
            else{
                echo "Vous devez écrire un message.";
            }
        }
        ?>
    </main>
</body>

</html>