<?php
	if(empty($_POST['id']) || empty($_POST['type']))
	{
		echo '<div class="title">Erreur</div>Erreur dans la selection de l\'article du panier.';
	}
	else
	{
		switch($_POST['type'])
		{
			case "augmenter":
			$_SESSION['panier']['article'][$_POST['id']]['quantite']++;
			break;
			
			case "reduire":
			if($_SESSION['panier']['article'][$_POST['id']]['quantite']>1)
			{
				$_SESSION['panier']['article'][$_POST['id']]['quantite']--;
			}
			else
			{
				unset($_SESSION['panier']['article'][$_POST['id']]);
			}
			break;
			
			case "supprimer":
			unset($_SESSION['panier']['article'][$_POST['id']]);
			break;
		}
		echo '<div class="title">Modification effectuee</div>Votre selection a ete modifie sur votre panier.';
	}
?>