<?php
include('profil.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil Utilisateur</title>
	<link rel="stylesheet" href="../css/profil.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<div class="photo">
				<img src="https://via.placeholder.com/150">
			</div>
			<div class="info">
				<h1><?php echo $user["name"];?></h1>
				<p><?php echo "@".$user["username"];?></p>
				<p><strong>Followers: </strong> <?php echo $followers;?></p>
				<p><strong>Following: </strong> <?php echo $followings;?></p>
			</div>
		</div>
		<div class="content">
			<p><?php echo $user["bio"];?></p>
			
		</div>
	</div>
	<script src="../js/profil.js"></script>
</body>
</html>
