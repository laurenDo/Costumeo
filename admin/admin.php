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

?>
<h1>Bienvenue sur l'interface admin, <?php echo $_SESSION['username']; ?></h1>
<br><a href="?action=add">Ajouter un produit</a>
<a href="?action=modifyanddelete">Modifier / Supprimer un produit</a><br><br>
<?php
	if(isset($_SESSION['username'])) {
		if (isset($_GET['action'])) {
		if($_GET['action']=='add') {
			if(isset($_POST['submit'])) {
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$img = $_FILES['img']['name'];
				$imgtemp = $_FILES['img']['tmp_name'];
				$tag=$_POST['tags'];
				$sexe=$_POST['sexe'];
				if (!empty($imgtemp)) {
					$image =explode('.',$img);
					$image_ext = end($image);
					if (in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false) {
						echo "Veuillez inserer une image avec la bonne extension. (png, jpg, jpeg)";
					}
					else {
						$image_size = getimagesize($imgtemp);
						if ($image_size['mime']=='image/jpeg') {
							$img_src = imagecreatefromjpeg($imgtemp);
						}
						else if ($image_size['mime']=='image/png') {
							$img_src = imagecreatefrompng($imgtemp);
						}
						else {
 							$img_src = false;
							echo "Entrez une image valide";
						}

						if ($img_src!==false) {
							$image_width = 200;
							if ($image_size[0]==$image_width) {
							 	$image_finale=$img_src;
							 } 
							else {
								$new_width[0]=$image_width;
								$new_height[1]= 200;
								$image_finale=imagecreatetruecolor($new_width[0], $new_height[1]);
							 	imagecopyresampled($image_finale, $img_src, 0, 0, 0, 0, $new_width[0], $new_height[1], $image_size[0], $image_size[1]);
							 }

							 imagejpeg($image_finale, 'Pictures/'.$title.'.jpg');
						}
					}
				}
				else {
					echo "Veuillez inserer une image";
				}
				if($title&&$description&&$price&&$tag&&$sexe) {
					try
					{
						$bdd = new PDO('mysql:host=localhost;dbname=Costumeo;charset=utf8', 'root', 'r6tvy6', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					}
					catch (Exception $e)
					{
        					die('Mistake: ' . $e->getMessage());
					}

					$insert = $bdd->prepare("INSERT INTO Costumeo.Produits (Libelle, Description, Prix_vente, Tags, Sexe) VALUES('$title', '$description', '$price', '$tag', '$sexe')");
					$insert->execute();
				}
				else {
					echo "Veuillez remplir tous les champs";
				}
			}
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<h3>Titre du produit</h3><input type="text" name="title"/>
				<h3>Description</h3><textarea name="description"></textarea>
				<h3>Prix</h3><input type="text" name="price"/>
				<h3>Sexe (2 = homme, 1 = femme)</h3><input type="text" name="sexe"/>
				<h3>TAGS</h3><input type="text" name="tags"/>
				<br><br>
				<h3>Image</h3>
				<input type="file" name="img" /><br><br>
				<input type="submit" name="submit"/>
			</form>
			<?php
		}
		else if ($_GET['action']=='modifyanddelete') {
				$select = $bdd->prepare("SELECT * FROM Costumeo.Produits");
				$select->execute();
				while($s=$select->fetch(PDO::FETCH_OBJ)){ 
				?>
				<h2><?php echo $s->Libelle;?></h2>
				<a href="?action=modify&amp;ID=<?php echo $s->ID; ?>">Modifier</a>
				<a href="?action=delete&amp;ID=<?php echo $s->ID; ?>">Supprimer</a><br><br>
				<?php
			}
		}
		else if ($_GET['action']=='modify') {
			$ID=$_GET['ID'];
			$select = $bdd->prepare("SELECT * FROM Costumeo.Produits WHERE ID=$ID");
			$select->execute();
			$data=$select->fetch(PDO::FETCH_OBJ);

			?>
			<form action="" method="post">
				<h3>Titre du produit</h3><input value="<?php echo $data->Libelle; ?>" type="text" name="title"/>
				<h3>Description</h3><textarea name="description"><?php echo $data->Description; ?></textarea>
				<h3>Prix</h3><input value="<?php echo $data->Prix_vente; ?>" type="text" name="price"/>
				<h3>Sexe (2 = homme, 1 = femme)</h3><input value="<?php echo $data->Sexe; ?>" type="text" name="sexe"/>
                                <h3>TAGS</h3><input value="<?php echo $data->Tags; ?>" type="text" name="tags"/>
				<br><br>
				<input type="submit" name="submit" value="modifier"/>
			</form>
			<?php

			if (isset($_POST['submit'])) {
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$update=$bdd->prepare("UPDATE Costumeo.Produits SET Libelle='$title', Description='$description', Prix_vente='$price', Tags='$tag', Sexe='$sexe' WHERE ID=$ID");
				$update->execute();

				header('Location: admin.php/action=modifyanddelete');
			}
		}
		else if ($_GET['action']=='delete') {
			$ID=$_GET['ID'];
			$delete = $bdd->prepare("DELETE FROM Costumeo.Produits WHERE ID=$ID");
			$delete->execute();

		}
		else {
			die('Une erreur a eu lieu.');
		}
	}
}
	else {
		header('Location: ../index.html');
	}
?>



