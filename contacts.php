<?php require 'inc/header.php'; ?>
<?php 
//Contact de la page d'accueil pour envoi message à Joy
if (isset($_POST["submit"])) {
		$email = $_POST['email'];
		$message = $_POST['message'];
		$to = 'costumeo.entreprise@gmail.com'; 
		$subject = 'Demande de contact';
		$body ="E-Mail: $email\n Message:\n $message";
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Entrez un mail valide.';
		}
		if (!$_POST['message']) {
			$errMessage = 'Entrez un message valide';
		}
		if (!$errEmail && !$errMessage) {
	mail ($to, $subject, $message, $body, $email);
	header('Location: index.php');
	$_SESSION['flash']['success'] = "Votre message a bien été envoyé.";
	
	}
}
?>
<!DOCTYPE html>
<!-- MISE EN FOME HTML-->
<body style="margin-top: 5%;margin-bottom: 3%;">
<div class="container">
<div class="row">
  <form role="form" action="" method="post" >
    <div class="col-lg-6" style="border: black dotted 1px;margin-bottom: 3%;">
      <div class="form-group">
        <label for="InputName">Email</label>
        <div class="input-group">
          <input type="text" class="form-control" name="email" id="InputName" placeholder="Votre email" >
          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
      </div>
      <div class="form-group">
        <label for="InputMessage">Message</label>
        <div class="input-group">
          <textarea name="message" id="InputMessage" class="form-control" rows="5" placeholder="Votre message" ></textarea>
          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
      </div>
<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary pull-left" style="margin-bottom: 5%;">

  </div>
   <div class="col-xs-3" style="margin-left:18%">
      <img class="img-circle img-responsive img-center" id="mdr1" src="img/joy.jpg" alt="" style="width: 160px;margin-left: 9%;">
            <h2 id="hilol2">Joy BORG</h2>
<p id="hilol1" style="text-align: center;margin-left: -21%;">

            <i>Joy BORG, professeur de danse classique et fondatrice du projet Costumeo.</i></p>
          </div>
  </form>
  <hr class="featurette-divider hidden-lg">

</div>
</div>
</body>
<?php require 'inc/footer.php'; ?>
