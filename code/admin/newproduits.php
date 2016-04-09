<div>
	<h2>Nouveaux Produits</h2>
<?php
	$select = $bdd->prepare("SELECT * FROM Produits ORDER BY ID DESC LIMIT 0,3");
	$select->execute();

	while($s=$select->fetch(PDO::FETCH_OBJ)) {
		?>
		<img src="admin/imgs/<?php echo $s->Libelle; ?>.jpg"/>
		<h2><?php echo $s->Libelle; ?></h2>
		<?php
	}
?>

</div>