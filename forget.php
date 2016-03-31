  <?php require 'inc/header.php'; ?>
  <?php if (!empty($_POST) && !empty($_POST['email'])) {
	//Appel à un fichier qui fait connexion BDD de Costumeo 
       require_once 'inc/db.php';
       require_once 'inc/function.php';

	//Veirfication mail existe dans la BDD
       $req = $pdo->prepare('SELECT * FROM User WHERE email = :email AND confirmed_date IS NOT NULL' );
       $req->execute(['email' => $_POST['email']]);
       $user = $req->fetch();
       if($user) {
			session_start();
			$reset_toke = str_random(60); //Generation token par la fonction str_random cf fonctions.php
			$pdo->prepare('UPDATE User SET reset_toke = ?, reset_date = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
  			$_SESSION['flash']['success'] = 'Un mail de rappel de mot de passe vous a a bien été envoyé sur votre e-mail';
			//ENvoie du MDP de reinitialisation avec token
			mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Pour réinitialiser le mot de passe de votre compte, cliquez sur ce lien \n\nhttp://localhost:8888/Costumeo_member/reset.php?id={$user->id}&token=$reset_toke");
	               header('Location: login.php');
      			//exit();
	}else {
		      session_start();
            	      $_SESSION['flash']['danger'] = "L'identifiant ou mot de passe que vous avez entré sont invalides";
	      }
	}

 ?>

<?php require 'inc/header2.php'; ?>

      <h2>Entrez votre e-mail</h2>
      <!-- Mise en forme HTML-->
      <form action="" method="POST">
      	    <div class="form-group">
		<input type="email" name="email" class="form-control" >
 	    </div>
		<button type="submit" class="btn btn-primary">Accedez au changement</button>
	</form>

<?php require 'inc/footer2.php'; ?>
