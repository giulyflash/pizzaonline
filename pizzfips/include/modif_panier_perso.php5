<?php
	if(!isset($_POST['id']) || empty($_POST['type']))
	{
		echo '<div class="title">Erreur</div>Erreur dans la selection de la crêpe personnalisée.';
	}
	else
	{
		switch($_POST['type'])
		{
			case "augmenter":
			$_SESSION['panier']['perso'][$_POST['id']]['quantite']++;
			break;
			
			case "réduire":
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
		echo '<div class="title">Modification effectuée</div>Votre sélection a été modifiée sur votre panier.';
	}
?>