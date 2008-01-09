 <?php
 	require('outils/outilsBD.php');
 	$nom = $_POST['nomItem'];
	$valeur = $_POST['valItem'];
	if($valeur > 0) queryDB("UPDATE stocks SET quantite = (quantite+".$valeur.") WHERE ingredient='".$nom."'", 'update');
	header('location:indexAdmin.php5?page=modifierIngredientsForm');
?>