<?php
session_start();
try
{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=Costumeo;charset=utf8', 'root', 'Chopper1697', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Mistake: ' . $e->getMessage());
}
if (isset($_GET['show'])) {
$products= $_GET['show'];
$select = $bdd->prepare("SELECT Email FROM Costumeo.Produits WHERE Libelle='$products'");
$select->execute();
$s=$select->fetch(PDO::FETCH_OBJ);
if (isset($_POST["submit"])) {
		$email = $_POST['email'];
		$message = $_POST['message'];
		$from = 'Costumeo';
		$to = $s['Email']; 
		$subject = 'Demande Achat Du Produit';

		$body ="E-Mail: $email\n Message:\n $message";
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Entrez un mail valide.';
		}

		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		if (!$errEmail && !$errMessage) {
	mail ($to, $subject, $message, $body, $from);
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	        <meta name="description" content="">
		    <meta name="author" content="">
		        <title>Customeo - Recherche</title>
		<link rel="stylesheet" href="index.css" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="produits.css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">$('#modal').modal();</script>
	</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			        <![endif]-->
				</head>
<script>
$(function () {
    $('#Container').mixItUp();
  });
</script>
<body>
<div class="nav">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a href="index.php" onclick = $("#menu-close").click(); ><img src="img/logo2.png" id="logo" style="width:37%"></a>
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
      </div>
<!--<a class="navbar-brand" href="#">Costumeo</a>-->
<!-- Menu situé dans le header. -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="margin-top:4px">
	                <?php if(isset($_SESSION['auth'])): ?>


                <li>
		                  <a href="logout.php">Se deconnecter (<?= $_SESSION['auth']->username; ?>)</a>
				                  </li>

                <li>
		                  <a href="annonce.php">Postez votre annonce ici</a>
				                  </li>
						                  <li>
		                  <a href="code/">Panneau d'administration</a>
				                  </li>

             <?php else: ?>

              <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="register.php">S'inscrire</a></li>
	      <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="login.php">Se connecter</a></li>
	      <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="#">Contactez nous</a></li>
        <li style="font-family: Trebuchet MS;font-size: 13px; margin-top:12px"><form action="recherche.php" method="post">
          <input type="text" name="search" placeholder=" Rechercher "/>
          <input type="submit" value="Go !" />
        </form></li>
            <?php endif; ?>
	              </ul>
      </div>
<!-- Fin du menu header. -->
    </div>
<!-- /.container -->
  </nav>
		</div><br><br><br><br><br><br><br><br><br>
<div class="controls">

  <label>Filter:</label>
  
  <button class="filter" data-filter="all">All</button>
  <button class="filter" data-filter=".category-1">Femme</button>
  <button class="filter" data-filter=".category-2">Homme</button>
  
  <label>Sort:</label>
  
  <button class="sort" data-sort="myorder:asc">Prix Asc</button>
  <button class="sort" data-sort="myorder:desc">Prix Desc</button>
</div>
<section id="plans">
<div id="Container" class="container">
<div class="row">
<ul>
<?php require_once("connectproduits.php"); ?>
</ul>
</div>
<div class="gap"></div>
  <div class="gap"></div>
</div>
</section>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Laissez un message !</h4>
        </div>
        <div class="modal-body">
    <form class="form-horizontal"  method="post" name="commentform" action="produits.php">
	  <fieldset>
	    <div class="form-group">
	      <label for="email" class="col-lg-2 control-label">E-mail</label>
	      <div class="col-lg-10">
	        <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse e-mail" REQUIRED>
		</div>
	    </div>
	    <div class="form-group">
        	<label for="comment" class="col-sm-2 control-label">Message</label>
        	<div class="col-sm-10">
        	        <textarea rows="4" class="form-control" id="comments" name="message" placeholder="Votre Message" REQUIRED></textarea>

		</div>
    	    </div>
	    <div class="form-group">
	      <div class="col-lg-10 col-lg-offset-2">
	        <button type="reset" class="btn btn-default">Annuler</button>
	      </div>
	    </div> 
	    <div class="modal-footer">
	   <div class="col-sm-10 col-sm-offset-2">
            <input id="send_btn" name="submit" type="submit" value="Send" class="btn btn-primary">
        </div>
    </div>
	  </fieldset>
	</form>
        </div>
       
      </div>
      
    </div>
  </div>
  
</div>
<script>
$('#send_btn').popover({content: 'Merci !'}, 'click');
</script>
</body>
</html>
