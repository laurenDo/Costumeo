<?php

	$user_id = $_GET['id'];
	$token = $_GET['token'];

	require 'inc/db.php';
	//Slection d'un ID ( correspondant a un utilisateur)
	$req = $pdo->prepare('SELECT * FROM User WHERE id = ?');
	$req->execute([$user_id]);
	$user = $req->fetch();

	session_start();

	//Verification Token_userdanslaBDD = Token_envoi
	if ($user && $user->confirmation_token == $token) {
	   $pdo->prepare('UPDATE User SET confirmation_token = NULL, confirmed_date = NOW() WHERE id = ?')->execute([$user_id ]);
           $_SESSION['flash']['success'] = "Votre compte a bien été validé."; //Envoi d'un message de confirmation de l'inscription
           $_SESSION['auth'] = $user;
   	   header('Location: account.php');
	 }else {
	 	//Msg d'erreur dans le cas ou le token a expire (= utilisation unique du token) et/ou ne correspond pas
		       $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
 		       header('Location: login.php');
	      }
