<?php
	if(empty($_POST['ingredient']) || empty($_POST['quantite']) || empty($_POST['prix']))
	{
		echo '<div class="title">Erreur</div>Erreur dans l\'ajout de votre crepe personnalisee.';
	}
	else
	{
		$_SESSION['panier']['perso'][$_SESSION['id_perso']]['prix']=$_POST['prix'];
		$_SESSION['panier']['perso'][$_SESSION['id_perso']]['quantite']=$_POST['quantite'];
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$_SESSION['panier']['perso'][$_SESSION['id_perso']]['ingredient'][]=$ingredient;
		}
	}
	$_SESSION['id_perso']++;
	
	echo '<div class="title">Ajout effectue</div>Votre crepe personnalisee a ete ajoutee au panier.';
?>