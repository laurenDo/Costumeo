 <?php require 'inc/header2.php'; ?>
<?php if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    
    require_once 'inc/db.php';
    require_once 'inc/function.php';
    
    //Permet connexion par mail ou pseudo et verification si mail confirmé
    $req = $pdo->prepare('SELECT * FROM User WHERE (username = :username OR email = :username) AND ( confirmed_date IS NOT NULL)' );
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    		//Verification combinaison MDP/login
	    if(password_verify($_POST['password'], $user->password)) {
    		session_start();
		$_SESSION['auth'] = $user;
 		$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté à Costumeo';
		header('Location: account.php');
		//exit();
 	    }else {
		  	session_start();
			$_SESSION['flash']['danger'] = "L'identifiant ou mot de passe que vous avez entré sont invalides";
			header('Location: login.php');
		  }
	    }
?>

    <h1>Se connecter</h1>
    <form action="" method="POST">
    		<!-- MISE NE FORME HTML-->
      	    <div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">Pseudomyme</label>
		<input type="text" name="username" class="form-control" >
	    </div>
	<div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">Mot de passe <a href="forget.php">(Mot de passe oublie ?)</a></label>
		<input type="password" name="password" class="form-control" >
	</div>
	<button type="submit" class="btn btn-primary">Se connecter</button>
	</form>
<?php require 'inc/footer2.php'; ?>
