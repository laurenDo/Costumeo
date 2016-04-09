<!DOCTYPE html>
<!-- Header utilise pour les pages produits-->
<html>
<head>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="description" content="">
        <meta name="author" content="">
            <title>Customeo - Page d'index</title>
          <!-- Bootstrap Core CSS -->
              <link href="css/bootstrap.css" rel="stylesheet">
            <!-- Custom CSS -->
                <link href="css/stylish-portfolio.css" rel="stylesheet">
              <!-- Custom Fonts -->
                  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
                <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
              <![endif]-->
        </head>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script>
$(function () {
    $('#Container').mixItUp();
  });
</script>
<body>
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
                <li style="font-family: Trebuchet MS;font-size: 13px;">
                      <a href="annonce.php">Postez votre annonce ici</a>
                </li>
                <li style="font-family: Trebuchet MS;font-size: 13px;">
                      <a href="account.php">Page d'accueil</a>
                </li>
                <li style="font-family: Trebuchet MS;font-size: 13px;">
                      <a href="logout.php">Se deconnecter (<?= $_SESSION['auth']->username; ?>)</a>
                </li>

             <?php else: ?>

              <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="register.php">S'inscrire</a></li>
        <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="login.php">Se connecter</a></li>
        <li style="font-family: Trebuchet MS;font-size: 13px;"><a href="contacts.php">Contactez nous</a></li>

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
</section>
