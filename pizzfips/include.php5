<?php
	if(empty($_GET['page']))
	{
		$page="accueil.php5";
		$title="Accueil";
	}
	else
	{
		switch($_GET['page'])
		{
			case "accueil":
			$page="accueil.php5";
			$title="Accueil";
			break;
			
			case "menu":
			$page="menu.php5";
			$title="Nos menus";
			break;
			
			case "pizza":
			$page="pizza.php5";
			$title="Nos pizzas";
			break;
			
			case "panier":
			$page="panier.php5";
			$title="Votre panier";
			break;
			
			case "inscription":
			$page="inscription.php5";
			$title="S'inscrire";
			break;
		}
	}
?>
