<?php 
     if(isset($_POST['submit'])) {
         $title=$_POST['title'];
                                $description=$_POST['description'];
                                $price=$_POST['price'];
                                $img = $_FILES['img']['name'];
                                $imgtemp = $_FILES['img']['tmp_name'];
                                $tag=$_POST['tags'];
                                $email=$_POST['email'];
                                $sexe=$_POST['sexe'];
                                $quantite=$_POST['quantite'];
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
                                                         imagejpeg($image_finale, 'img/'.$title.'.jpg');
                                                }
                                        }
                                }
                                else {
                                        echo "Veuillez inserer une image";
                                }
                                if($title&&$price) {
                                        try
                                        {
                                                $bdd = new PDO('mysql:host=localhost;dbname=Costumeo;charset=utf8', 'root', 'r6tvy6', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                        }
                                        catch (Exception $e)
                                        {
                                                die('Mistake: ' . $e->getMessage());
                                        }
                                        $insert = $bdd->prepare("INSERT INTO Costumeo.Produits (Libelle, Description, Email, Prix_vente, Tags, Sexe, Nombres_produit) VALUES('$title', '$description', '$email', '$price', '$tag', '$sexe', '$quantite')");
                                        $insert->execute();
                                        
                                $message = "Un utilisateur souhaiterait ajouter un produit. Veuillez vous rendre sur la page admin et ajouter ou supprimer le produit.";
                                mail('velia_k@etna-alternance.net', "Demande d'ajout de produits", $message);
                                header('Location: produits.php');
                                }
                                else {
                                        echo "Veuillez remplir tous les champs";
                                }
                            }
?>

<html>


<!DOCTYPE html>
<html lang="fr">
<?php require 'inc/header.php'; ?>
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
<body>

                        <form action="" method="post" enctype="multipart/form-data" style="margin-top: 6%;
background-color: #222;
text-align: center;
border: black solid 1px;
margin-left: 17%;
margin-right: 20%;
border-radius: 7px;">
<br><h1 style="color:white">Ajouter un produit</h1><br>


                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Titre du produit:</h3><input style="color: black" type="text" name="title"/>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Description:</h3><textarea style="color: black" name="description"></textarea>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Email:</h3><input style="color: black" type="text" name="email"/>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Prix:</h3><input style="color: black" type="text" name="price"/>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Quantite:</h3><input style="color: black" type="text" name="quantite"/>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Sexe:</h3><select style="color: black;font-size: 15px;font-family: Trebuchet MS;" name="sexe"><option style="color: black" type="text"  value="1"/>Femme</option>
                                <option style="color: black" type="text" value="2"/>Homme</option></select>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">TAGS:</h3><input style="color: black" type="text" name="tags"/>
                                <br><br>
                                <h3 style="color: white;font-size: 15px;font-family: Trebuchet MS;">Image:</h3>
                                <input type="file" name="img" style="margin-left:45.5%"/><br><br>
                                <input style="color: black" type="submit" name="submit" value="Ajouter" style="margin-bottom: 15px;"/>
                        </form>
</body>
</html>
