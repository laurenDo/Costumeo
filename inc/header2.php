<?php 
  if (session_status() == PHP_SESSION_NONE) {
    
    session_start();

  }
 ?>
<!DOCTYPE html>
<!-- Header utilise pour page de connexion-->

<html lang="fr">
  <head>
      <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Customeo - Page d'index</title>
    <!-- Bootstrap Core CSS -->
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

    <title>Costumeo</title>


<!-- reCaptcha -->
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <!-- Bootstrap core CSS -->
    <link href="css/app.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a href="index.php" onclick = $("#menu-close").click(); ><img src="img/logo2.png" id="logo" style="width:37%"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
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

            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

   <div class="container">

  <?php if (isset($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type => $message): ?>
          <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>
          </div>
      <?php endforeach; ?>  
      <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>

     





















