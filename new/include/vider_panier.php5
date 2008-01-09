<h1>Suppression d'éléments du panier</h1>
<?php
	if(empty($_GET['type']) || $_GET['type']=="tous")
	{
		unset($_SESSION['panier']);
		echo "Vous venez de vider entièrement votre panier.";
		echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
	}
	else
	{
		switch($_GET['type'])
		{
			case "article":
			unset($_SESSION['panier']['article']);
			echo "Vous venez de supprimer tous les articles de votre panier.";
			echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
			break;
			
			case "menu":
			unset($_SESSION['panier']['menu']);
			echo "Vous venez de supprimer tous les menus de votre panier.";
			echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
			break;
			
			case "perso":
			echo "Vous venez de supprimer tous les crêpes personnalisées de votre panier.";
			echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
			unset($_SESSION['panier']['perso']);
			break;
		}
	}
?>