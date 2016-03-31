<?php 
	//Fonction permettant le debug 
	function debug($variable){

		echo '<pre>'. print_r($variable, true) . '</pre>';
	}
	//Fonction permettant de creer un token
	function str_random($lenght){

		$alphanum = "1234567890azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
		return substr(str_shuffle(str_repeat($alphanum, $lenght)), 0, 60);
	}
	//Fonction permetttant de checker si inscription d'un utilisateur est complete
	function member_only(){
		
		if (session_status() == PHP_SESSION_NONE) {
    
   			 session_start();

  		 }

		if (!isset($_SESSION['auth'])) {

			$_SESSION['flash']['danger'] = "Vous ne pouvez pas acceder a cette page";

			header('Location: login.php');

			exit();
		}

	}
