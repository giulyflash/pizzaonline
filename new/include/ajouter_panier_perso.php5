<?php
	if(empty($_POST['type']) || empty($_POST['ingredient']) || empty($_POST['quantite']) || empty($_POST['prix']))
	{
		echo '<div class="title">Erreur</div>Erreur dans l\'ajout de votre cr�pe personnalis�e.';
		echo '<br /><a href="index.php5?page=voscrepes">Retour � l\'�cran de s�lection des cr�pes personnalis�e</a>';
		echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
	}
	else
	{
	
		$id_perso="";
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$id_perso+=$ingredient;
		}
		$_SESSION['panier']['perso'][$id_perso]['type']=$_POST['type'];
		$_SESSION['panier']['perso'][$id_perso]['prix']=$_POST['prix'];
		if(empty($_SESSION['panier']['perso'][$id_perso]['quantite']))
		{
			$_SESSION['panier']['perso'][$id_perso]['quantite']=$_POST['quantite'];
		}
		else
		{
			$_SESSION['panier']['perso'][$id_perso]['quantite']+=$_POST['quantite'];
		}
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$_SESSION['panier']['perso'][$id_perso]['ingredient'][]=$ingredient;
		}
	}
	
	echo '<div class="title">Ajout effectu�</div>Votre cr�pe personnalis�e a �t� ajout�e au panier.';
	echo '<br /><a href="index.php5?page=voscrepes">Retour � l\'�cran de s�lection des cr�pes personnalis�e</a>';
	echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
?>