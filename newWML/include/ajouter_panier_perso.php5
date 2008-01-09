<?php
	if(empty($_POST['type']) || empty($_POST['ingredient']) || empty($_POST['quantite']) || empty($_POST['prix']))
	{
		echo '<h1>Erreur</h1>Erreur dans l\'ajout de votre crêpe personnalisée.';
		echo '<br /><a href="index.php5?page=voscrepes">Retour à l\'écran de sélection des crêpes personnalisée</a>';
		echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
	}
	else
	{
		$id_perso="";
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$id_perso.=$ingredient;
		}
		if(empty($_SESSION['panier']['perso'][$id_perso]['quantite']))
		{
			$_SESSION['panier']['perso'][$id_perso]['type']=$_POST['type'];
			$_SESSION['panier']['perso'][$id_perso]['prix']=$_POST['prix'];
			$_SESSION['panier']['perso'][$id_perso]['quantite']=$_POST['quantite'];
			foreach ($_POST['ingredient'] as $ingredient)
			{
				$_SESSION['panier']['perso'][$id_perso]['ingredient'][]=$ingredient;
			}
		}
		else
		{
			$_SESSION['panier']['perso'][$id_perso]['quantite']+=$_POST['quantite'];
		}
		echo '<h1>Ajout effectué</h1>Votre crêpe personnalisée a été ajoutée à votre panier.';
		echo '<br /><a href="index.php5?page=voscrepes">Retour à l\'écran de sélection des crêpes personnalisée</a>';
		echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
	}
?>