<?php
	if(empty($_POST['ingredient']) || empty($_POST['quantite']) || empty($_POST['prix']))
	{
		echo '<div class="title">Erreur</div>Erreur dans l\'ajout de votre crepe personnalisee.';
	}
	else
	{
		foreach ($_POST['ingredient'] as $ingredient)
		{
			echo $ingredient;
		}
		echo $_POST['prix'];
	}
?>