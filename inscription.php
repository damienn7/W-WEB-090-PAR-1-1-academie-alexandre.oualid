<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form action="" method="POST">
        <label for="email">Email</label>
        <input autocomplete="off" type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
        <label for="password">Password</label>
        <input type="password" name="password" required><br>
        <label for="name">Firstname Lastname</label>
        <input type="text" name="name" required><br>
        <label for="username">Username</label>
        <input type="text" name="username" required><br>
        <label for="birthdate">Birthdate</label>
        <input type="date" name="birthdate" required><br>
        <label for="gender">Gender</label>
        <select name="gender" id="gender" required>
            <option value="Autre">Autre</option>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select><br>
        <label for="city">City</label>
        <input type="text" name="city" id="city"><br>
        <input type="submit" name="submit" id="submit" value="S'inscrire">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $username = $_POST["username"];
        $birthdate = $_POST["birthdate"];
        $gender = $_POST["gender"];
        $city = $_POST["city"];

        $salt = "vive le projet tweet_academy";
        $password_hash = hash('ripemd160', $salt . $password);

        include("conn.php");
        try {

            $sql = "INSERT INTO users (email, password, name, username, birthdate, gender, city)
                VALUES (:email, :password, :name, :username, :birthdate, :gender, :city)";
            $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password_hash);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':city', $city);

            $stmt->execute();
            header("Location: /html/index.html");
        } catch (Exception $e) {
            echo "Une erreur est survenue veuillez remplir le formulaire correctement.";
            die('Erreur : ' . $e->getMessage());
        }
    }
    ?>
</body>

</html>