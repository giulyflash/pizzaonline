<?php
	// gestion de la connexion
	session_start();
	if(isset($_SESSION['user_id']))
	{
		$connecte=true;
		$user_id=$_SESSION['user_id'];
		$login_name=$_SESSION['login'];
	}
	else
	{
		$connecte=false;
		$user_id=0;
	}
	
	// gestion des pseudo frame
	if(empty($_GET['page']))
	{
		$page="include/accueil.php5";
		$title="Accueil";
	}
	else
	{
		switch($_GET['page'])
		{
			case "accueil":
			$page="include/accueil.php5";
			$title="Accueil";
			break;
			
			case "menu":
			$page="include/menu.php5";
			$title="Nos menus";
			break;
			
			case "pizza":
			$page="include/pizza.php5";
			$title="Nos pizzas";
			break;
			
			case "panier":
			$page="include/panier.php5";
			$title="Votre panier";
			break;
			
			case "inscription":
			$page="include/inscription.php5";
			$title="S'inscrire";
			break;
			
			case "fin_inscription":
			$page="include/fin_inscription.php5";
			$title="Fin de l'inscription";
			break;
			
			case "deconnexion";
			$page="include/deconnexion.php5";
			$title="Deconnexion";
			session_unset();
			session_destroy();
			break;
		}
	}
?>
