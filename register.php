 <?php
	require_once 'inc/function.php';
	session_start();
	//Gestion du formulaire d'inscription
	if (!empty($_POST)) {
		$errors = array();
		//Gestion d'erreur avec des REGEX 
		require_once 'inc/db.php';
			if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
				$errors['username'] = "Votre pseudo n'est pas valide (alphanumerique)";
				//Check dans la BDD si pseudo est existant
			}else {
				$req = $pdo->prepare('SELECT id FROM User WHERE username = ?');
		        $req-> execute([$_POST['username']]);
				$user = $req->fetch();
					if ($user) {
						$errors['username'] = "Ce pseudo est déjà utilisé par un autre utilisateur, choisissez-en un autre";
	   		        	}
				}
				 //Check dans la BDD si email est existant
			if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			    $errors['email'] = "Votre e-mail n'est pas valable";
			}else {
				$req = $pdo->prepare('SELECT id FROM User WHERE email = ?');
				$req-> execute([$_POST['email']]);
				$user = $req->fetch();
					if ($user) {
						$errors['email'] = "Cet email est déjà utilisé par un autre utilisateur, choisissez-en un autre";
					}
				}
			    //Check la correspondance des MDP
			if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
				$errors['password'] = "Votre mot de passe n'est pas valide";
			}
			if (empty($_POST['conditionUtilisation'])){
				$errors['conditionUtilisation'] = "Vous n'assez pas accepter les conditions d'utilisateur";
			}
			//Cryptage du MDP entré pour que personne (meme admin) ne puisse le recuperer dans la BDD
			if (empty($errors)) {
				$req = $pdo->prepare("INSERT INTO User SET username = ?, password = ?, email = ?, confirmation_token = ?");
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$token = str_random(60);
				$req->execute([$_POST['username'], $password, $_POST['email'], $token]);
				$user_id = $pdo->lastInsertId();
				mail($_POST['email'], 'Confirmation de votre compte utilisateur', "Pour valider votre compte, cliquez sur ce lien \n\nhttp://localhost:8888/Costumeo_member/confirm.php?id=$user_id&token=$token");
				$_SESSION['flash']['success'] = "Un email de confirmation vous a ete envoye";
				header('Location: login.php');
				die();
			}
		}
?>
<?php
$reCaptcha = new ReCaptcha($secret);
if(isset($_POST["g-recaptcha-response"])) {
    $resp = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
        );
    if ($resp != null && $resp->success) {echo "CAPTCHA OK";}
    else {echo "CAPTCHA incorrect";}
    }
?>

    <?php if (!empty($errors)): ?>
      	        <div class="alert alert-danger">
      	        	<!-- GESTION D'ERREURS-->
			<p>Vous n'avez pas rempli le formulaire d'inscription correctement !</p>
			<ul>
				<?php foreach ($errors as $error): ?>
				<li><?= $error; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>
<?php require 'inc/header2.php'; ?>
<h1>S'inscrire</h1>
<form action="" method="POST">
	<!-- MISE EN PAGE HTML-->
	<div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">Pseudo</label>
		<input type="text" name="username" class="form-control" >
	</div>
	<div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">E-mail</label>
		<input type="text" name="email" class="form-control" >
	</div>
	<div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">Mot de passe</label>
		<input type="password" name="password" class="form-control" >
	</div>
	<div class="form-group">
		<label for="" style="font-family: champagne__limousinesbold;font-weight: normal;font-size: 15px;color: darkgrey;">Confirmez votre mot de passe</label>
		<input type="password" name="password_confirm" class="form-control" >
	</div>
		<div class="g-recaptcha" data-sitekey="6LcqWRMTAAAAAJ2Fap-h7J6t0W_Jj7h00g4DVaVX"></div>
	<br>
	<br>
	<div class="form-group">
		<label><input type="checkbox" name="conditionUtilisation" class="form-control" ></input><a href="#conditionUtilisation">Je valide les conditions d'utilisation</a></label>
	</div>
	<br><br><br>
	<button type="" class="btn btn-primary">M'inscrire</button>
</form>
<?php  require 'inc/footer2.php'; ?>
