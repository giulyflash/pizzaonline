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
			$_SESSION['panier']['menu'][$_POST['id']]['quantite']++;
			break;
			
			case "réduire":
			if($_SESSION['panier']['menu'][$_POST['id']]['quantite']>1)
			{
				$_SESSION['panier']['menu'][$_POST['id']]['quantite']--;
			}
			else
			{
				unset($_SESSION['panier']['menu'][$_POST['id']]);
			}
			break;
			
			case "supprimer":
			unset($_SESSION['panier']['menu'][$_POST['id']]);
			break;
		}
		echo '<div class="title">Modification effectuée</div>Votre selection a été modifiée sur votre panier.';
	}
?>