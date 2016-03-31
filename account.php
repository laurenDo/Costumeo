<?php
	//Compte membre
	require_once 'inc/function.php';
	member_only();
	require_once 'inc/header2.php';
	if (!empty($_POST)) {
	   if ($_POST['password'] != $_POST['password_confirm']) {
	      			  $_SESSION['flash']['danger'] = "Veuillez entrer le même mot de passe dans les deux champs s’il vous plaît.";
	   }else {
		$user_id = $_SESSION['auth']->id;
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		require_once 'inc/db.php';
		$pdo->prepare('UPDATE User SET password = ? WHERE id = ?')->execute([$password, $user_id]);
		$_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié.";
		}
	   }
 ?>
	<h1>Bienvenue sur Costumeo, <?= $_SESSION['auth']->username; ?>.</h1>
	<!-- Liens menant a la page accueil et l'autre page modification du MDP-->
<a href="index.php" style="font-family: Trebuchet MS;margin-left: 4%;font-size: 17px;">• Cliquez ici pour accéder a la page d'accueil</a><br />
<a href="modify.php" style="font-family: Trebuchet MS;margin-left: 4%;font-size: 17px;">• Cliquez ici pour changer votre mot de passe</a>
<?php require_once 'inc/footer2.php'; ?>
