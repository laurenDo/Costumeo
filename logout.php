<?php
	//Permet la deconnexion : accessible seulement si on est connectes
	session_start();
	unset($_SESSION['auth']);
	$_SESSION['flash']['success'] = "Vous etes deconnecte de votre compte" ;
	header('Location: login.php');
