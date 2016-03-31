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

<h1>Administration connexion</h1>
<form action="" method="POST">
	<h3>Votre pseudo:</h3><input type="text" name="username"/><br><br>
	<h3>Votre mot de passe:</h3><input type="password" name="password"/><br><br>
	<input type="submit" name="submit"/><br><br>
</form>