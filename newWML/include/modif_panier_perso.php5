<?php
	if(!isset($_POST['id']) || empty($_POST['type']))
	{
		echo '<h1>Erreur</h1>Erreur dans la selection de la crêpe personnalisée.';
		echo '<br /><a href="index.php5?page=panier">Retour à votre panier</a>';
	}
	else
	{
		switch($_POST['type'])
		{
			case "augmenter":
			$_SESSION['panier']['perso'][$_POST['id']]['quantite']++;
			break;
			
			case "reduire":
			if($_SESSION['panier']['perso'][$_POST['id']]['quantite']>1)
			{
				$_SESSION['panier']['perso'][$_POST['id']]['quantite']--;
			}
			else
			{
				unset($_SESSION['panier']['perso'][$_POST['id']]);
			}
			break;
			
			case "supprimer":
			unset($_SESSION['panier']['perso'][$_POST['id']]);
			break;
		}
		echo '<h1>Modification effectuée</h1>Votre sélection a été modifiée sur votre panier.';
		echo '<br /><a href="index.php5?page=panier">Retour à votre panier</a>';
	}
?>