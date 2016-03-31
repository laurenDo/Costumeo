<?php
session_start();

$user = 'Costumeo';
$passworddef= 'r6tvy6';

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username&&$password) {
		if ($username==$user&&$password==$passworddef) {
			$_SESSION['username']=$username;
			header('Location: admin.php');
		}
		else {
			echo 'Vos identifiants ne correspondent pas.';
		}
	}
	else {
		echo 'Veuillez remplir les divers champs';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projet Code Camps - Customeo</title>
<meta charset="utf-8">
	<link rel="stylesheet" href="index.css" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="produits.css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>

<body>
<div class="col-md-4 text-center">
<div class="panel panel-danger panel-pricing">
<div class="panel-heading">
<i class="fa"></i>
<h1>Administration connexion</h1>
<div class="panel-body text-center">
<form action="" method="POST">
	<h3>Votre pseudo:</h3><input type="text" name="username"/><br><br>
	<h3>Votre mot de passe:</h3><input type="password" name="password"/><br><br>
	
	<div class="panel-footer"><input type="submit" name="submit" placeholder="Login"/><br><br></div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
