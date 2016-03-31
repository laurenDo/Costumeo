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
<div class="controls" >

  <label style="color:grey">Trier par sexe:</label>
  
  <button class="filter" data-filter="all">Tous</button>
    <button class="filter" data-filter=".category-1">Femme</button>
      <button class="filter" data-filter=".category-2">Homme</button><br><br>

  <label style="color:grey">Trier par prix:</label>

  <button  class="sort" data-sort="myorder:asc">Prix ascendant</button>
    <button  class="sort" data-sort="myorder:desc">Prix descendant</button>
</div>


<section id="plans">
<div id="Container" class="container">
<div class="row">
<ul>
<?php
//connexion a la database
    $host = "localhost";
        $user = "root";
	    $password = "r6tvy6";
	        $database_name = "Costumeo";
		    $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
		        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			    ));
		    if (isset($_GET['show'])) {
	$products= $_GET['show'];
	$select = $pdo->prepare("SELECT * FROM Costumeo.Produits WHERE Libelle='$products'");
	$select->execute();
	$s=$select->fetch(PDO::FETCH_OBJ);
	?>
		<div class="col-md-4 text-center">
<div class="panel panel-danger panel-pricing">
<div class="panel-heading">
<i class="fa"></i>
<h1><?php echo $s->Libelle;?></h1>
</div>
<div class="panel-body text-center">
<img class="img" src="img/<?php echo $s->Libelle; ?>.jpg"/></a>
</div>
<div calss="panel-body text-center">
<h3 style="color:grey">Description: <?php echo $s->Description; ?></h3>
</div>
<div class="panel-body text-center">
<h3>Quantite: <?php echo $s->Nombres_produit; ?></h3>
</div>
<div class="panel-footer">
<button type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><h4><?php echo $s->Prix_vente; ?> Euros<br>Demander l'achat</h4> <span class="glyphicon glyphicon-shopping-cart"></span></button></a>
</div>
</div>
</div>

	<?php
}
else {
			    // recherche dans la base de donnee, requete limitee a max dix articles
			    $search=$_POST['search'];
			    $query = $pdo->prepare("select * from Produits where Tags LIKE '%$search%' LIMIT 0 , 10");
			    $query->bindValue(1, "%$search%", PDO::PARAM_STR);
			    $query->execute();
			    // affiche les resultats
			            if (!$query->rowCount() == 0) {
							while ($results = $query->fetch()) {
								?>
								<div class="col-md-4 text-center mix category-<?php echo $results['Sexe']; ?>" data-myorder="<?php echo $results['Prix_vente']; ?>">
									<div class="panel panel-danger panel-pricing">
										<div class="panel-heading">
											<i class="fa"></i>
											<h2><?php echo $results['Libelle'];?></h2>
										</div>
										<div class="panel-body text-center">
											<a href="?show=<?php echo $results['Libelle']; ?>"><img class="img" style="height:450px" src="img/<?php echo $results['Libelle']; ?>.jpg"/></a>
										</div>
										<div class="panel-footer">
											<a href="?show=<?php echo $results['Libelle']; ?>"><button type="button" class="btn btn-lg btn-block btn-primary"><h4><?php echo $results['Prix_vente']; ?> Euros<br><br>DETAILS</h4></button></a>
										</div>
									</div>
								</div>
								<?php
						    }
					        } else {
					        	?>
				           <h1 class="text-align"><?php echo 'Aucun produit !'; ?> </h1>
			           	<?php
			            }
			        }
?>

</ul>
</div>
<div class="gap"></div>
  <div class="gap"></div>
</div>
</section>
<div  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:grey" class="modal-title">Laissez un message !</h4>
        </div>
        <div class="modal-body">
    <form class="form-horizontal"  method="post" name="commentform" action="produits.php">
	  <fieldset>
	    <div class="form-group">
	      <label style="color:grey" for="email" class="col-lg-2 control-label">E-mail</label>
	      <div class="col-lg-10">
	        <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse e-mail" REQUIRED>
		</div>
	    </div>
	    <div class="form-group">
        	<label style="color:grey" for="comment" class="col-sm-2 control-label">Message</label>
        	<div class="col-sm-10">
        	        <textarea style="color:grey" rows="4" class="form-control" id="comments" name="message" placeholder="Votre Message" REQUIRED></textarea>

		</div>
    	    </div>
	    <div class="form-group">
	      <div class="col-lg-10 col-lg-offset-2">
	        <button style="color:grey" type="reset" class="btn btn-default">Annuler</button>
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
<footer style="background-color:#222">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1 text-center">
        <h4><strong style="color:white">Costumeo</strong>
        </h4>
        <h6 style="color:white">7 rue Maurice Grandcoing<br>Ivry-sur-Seine, 94200, France.</h6>
        <ul class="list-unstyled">
          <li ><i class="fa fa-envelope-o fa-fw"></i>  <a  href="mailto:costumeo.entreprise@gmail.com"><h6 style="color:white">costumeo.entreprise@gmail.com</h6></a>
          </li>
        </ul>
        <br>
        <ul class="list-inline">
          <li>
            <a href="#"><img src="img/contact_facebook.png"><!--<i class="fa fa-facebook fa-fw fa-3x"></i>--></a>
          </li>
          <li>
            <a href="#"><img src="img/contact_twitter.png"><!--<i class="fa fa-twitter fa-fw fa-3x"></i>--></a>
          </li>
          <li>
            <a href="#"><img src="img/contact_youtube.png"><!--<i class="fa fa-dribbble fa-fw fa-3x"></i>--></a>
          </li>
        </ul>
        <hr class="small2">
        <h6 style="color:white" class="text-muted">© 2015 Costumeo. Powered by VLPG™. All Rights Reserved.</h6>
      </div>
    </div>
  </div>
</footer>
  </body>
</html>
