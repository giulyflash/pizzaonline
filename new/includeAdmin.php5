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
		$title="Liste des commandes";
	}
	else
	{
		switch($_GET['page'])
		{
			case "commandes":
			$page="includeAdmin/cuistot.php5";
			$title="Liste des commandes";
			break;
			
			case "ajouterCrepes":
			$page="includeAdmin/ajouterCrepes.php5";
			$title="Ajouter une crêpes ou une gâlette";
			break;
			
			case "ajouterCrepesTraitement":
			$page="includeAdmin/ajouterCrepesTraitement.php5";
			$title="Ajouter une crêpes ou une gâlette";
			break;
			
			case "modifierSupprimerCrepes":
			$page="includeAdmin/modifierSupprimerCrepes.php5";
			$title="Modifier ou supprimer une crêpes ou une gâlette";
			break;
			
			case "formModifierCrepe":
			$page="includeAdmin/formModifierCrepe.php5";
			$title="Modifier ou supprimer une crêpes ou une gâlette";
			break;
			
			case "formModifierGalette":
			$page="includeAdmin/formModifierGalette.php5";
			$title="Modifier ou supprimer une crêpes ou une gâlette";
			break;
			
			case "modifierCrepesTraitement":
			$page="includeAdmin/modifierCrepesTraitement.php5";
			$title="Modifier ou supprimer une crêpes ou une gâlette";
			break;
			
			case "supprimerCrepesTraitement":
			$page="includeAdmin/supprimerCrepesTraitement.php5";
			$title="Modifier ou supprimer une crêpes ou une gâlette";
			break;
			
			case "modifierIngredientsForm":
			$page="includeAdmin/modifierIngredientsForm.php5";
			$title="Mettre a jour ou ajouter de nouveau ingredient";
			break;
			
			case "miseAjourIngredient":
			$page="includeAdmin/miseAjourIngredient.php5";
			$title="Mettre a jour les ingredients";
			break;
			
			case "ajoutIngredient":
			$page="includeAdmin/ajoutIngredient.php5";
			$title="Ajouter de nouveau ingredient";
			break;
			
			
		}
	}
?>
