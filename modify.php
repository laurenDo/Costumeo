<?php
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

	<h1>Voulez-vous changer de mot de passe, <?= $_SESSION['auth']->username; ?> ?</h1>
	<form action="" method="POST">

	      <div class="form-group">
				<input type="password" name ="password" placeholder = "Changer de mot de passe" class="form-control" >
				       		       </div>

							<div class="form-group">
									<input type="password" name ="password_confirm" placeholder = "Confirmez votre mot de passe" class="form-control">
									       		       </div>

												<div class="form-group">
														<button type="submit" class="btn btn-primary">Changez de mot de passe</button>
																      </div>
																	</form>

																	<?php require_once 'inc/footer2.php'; ?>
