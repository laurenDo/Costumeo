<?php
session_start();
try
{
$bdd = new PDO('mysql:host=localhost;dbname=Costumeo;charset=utf8', 'root', 'r6tvy6', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Mistake: ' . $e->getMessage());
	}
	if (isset($_GET['show'])) {
	   $products= $_GET['show'];
	   	      $select = $bdd->prepare("SELECT * FROM Costumeo.Produits WHERE Libelle='$products'");
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
							<img class="img" style="height:400px" src="img/<?php echo $s->Libelle; ?>.jpg"/></a>
							</div>
							<h3><?php echo $s->Description; ?></h3>
							<div class="panel-footer">
							<button type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><h4><?php echo $s->Prix_vente; ?> Euros<br>Demander l'achat</h4> <span class="glyphicon glyphicon-shopping-cart"></span></button></a>
							</div>
							</div>
							</div>

							<?php
							}
							else {
							$select = $bdd->prepare("SELECT * FROM Costumeo.Produits");
							$select->execute();
							while($s=$select->fetch(PDO::FETCH_OBJ)){
							?>
							<div class="col-md-4 text-center mix category-<?php echo $s->Sexe; ?>" data-myorder="<?php echo $s->Prix_vente; ?>">
							<div class="panel panel-danger panel-pricing">
							<div class="panel-heading">
							<i class="fa"></i>
							<h2><?php echo $s->Libelle;?></h2>
							</div>
							<div class="panel-body text-center">
							<a href="?show=<?php echo $s->Libelle; ?>"><img class="img" style="height:400px" src="img/<?php echo $s->Libelle; ?>.jpg"/></a>
							</div>
							<div class="panel-footer">
							<a href="?show=<?php echo $s->Libelle; ?>"><button type="button" class="btn btn-lg btn-block btn-primary"><h4><?php echo $s->Prix_vente; ?> Euros<br><br>DETAILS</h4></button></a>
							</div>
							</div>
							</div>
							<?php
							}
							}
							?>