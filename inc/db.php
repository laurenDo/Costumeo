<?php  
	//Connexion a la BASE DE DONNEES AVEC PDO
	$pdo= new PDO('mysql:dbname=Costumeo;host=127.0.0.1', 'root', 'Chopper1697');

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO:: FETCH_OBJ);
