<?php
	if(empty($_POST['type']) || empty($_POST['ingredient']) || empty($_POST['quantite']) || empty($_POST['prix']))
	{
		echo '<div class="title">Erreur</div>Erreur dans l\'ajout de votre crêpe personnalisée.';
	}
	else
	{
		$_SESSION['panier']['perso'][$_SESSION['id_perso']]['type']=$_POST['type'];
		$_SESSION['panier']['perso'][$_SESSION['id_perso']]['prix']=$_POST['prix'];
		$_SESSION['panier']['perso'][$_SESSION['id_perso']]['quantite']=$_POST['quantite'];
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$_SESSION['panier']['perso'][$_SESSION['id_perso']]['ingredient'][]=$ingredient;
		}
	}
	$_SESSION['id_perso']++;
	
	echo '<div class="title">Ajout effectue</div>Votre crêpe personnalisée a été ajoutée au panier.';
?>