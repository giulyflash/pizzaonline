<?php
	session_start();
	
	// gestion des id pour les crepes personnalisées
	if(!isset($_SESSION['id_perso']))
	{
		$_SESSION['id_perso']=0;
	}
	
	// gestion des pseudo frame
	if(empty($_GET['page']))
	{
		$page="includeAdmin/cuistot.php5";
		$title="Accueil";
	}
	else
	{
		switch($_GET['page'])
		{
			case "commandes":
			$page="includeAdmin/cuistot.php5";
			$title="Ajouter une crêpes ou une gâlette";
			break;
			
			case "ajouterCrepes":
			$page="includeAdmin/ajouterCrepes.php5";
			$title="Ajouter une crêpes ou une gâlette";
			break;
			
			case "supprimerCrepes":
			$page="includeAdmin/supprimerCrepes.php5";
			$title="Supprimer une crêpes ou une gâlette";
			break;
			
		}
	}
?>
