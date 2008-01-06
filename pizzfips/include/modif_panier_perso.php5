<?php
	if(!isset($_POST['id']) || empty($_POST['type']))
	{
		echo '<div class="title">Erreur</div>Erreur dans la selection de la crepe personnalisee.';
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
		echo '<div class="title">Modification effectuee</div>Votre selection a ete modifiee sur votre panier.';
	}
?>