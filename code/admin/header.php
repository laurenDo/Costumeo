<?php
	session_start();
					try{
						$bdd = new PDO('mysql:host=localhost;dbname=Costumeo', 'root', 'r6tvy6');
						$bdd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
						$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRNODE_EXCEPTION);
					}
					catch(Exception $e) {
						echo "Une erreur est survenue.";
						die();
					}

?>