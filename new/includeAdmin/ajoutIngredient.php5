 <?php
 	require('outils/outilsBD.php');
	$ingredient = "";
	$quantite = -1;
	$seuil = -1;
	$crepable = -1;
	$prix = -1;
	$sucresale = -1;
	
	if(empty( $_POST['nom']) echo "le nom n'est pas rensigné";
	else $ingredient = $_POST['nom'];	
		
	if($_POST['type'] == "ingredient")
	{
		$crepable = 1;
		$options_text = implode(', ',$_POST['saveur']);
		if(empty($options_text)) echo "Pour un ingredient au moins une saveur doit être renseigné";
		else
		{
			if($options_text == "sucre") $sucresale = 0;
			else if ($options_text == "sale") $sucresale = 1;
			else $sucresale = 2;
		}
	}
	else
	{
		$crepable = 0;
		$sucresale = 0;
	}
	if( $_POST['cout'] < 0) echo "le coût ne peut être négatif"; 
	else $prix = $_POST['cout'];
	
	if( $_POST['seuil'] < 0) echo "le seuil ne peut être négatif"; 
	else $seuil = $_POST['seuil'];
	
	if( $_POST['quantite'] < 0) echo "la quantité ne peut être négative"; 
	else $quantite = $_POST['quantite'];
	 
	if($ingredient != "" && $quantite != -1 && $seuil != -1 && $crepable != -1 && $prix != -1 && $surcesale != -1 ) {
		queryDB("INSERT INTO stocks VALUES('".$ingredient."',".$quantite.",".$seuil.",".$crepable.",".$prix.",".$sucresale)")", 'update');
		header('location:indexAdmin.php5?page=modifierIngredientsForm');
	}
	header('location:indexAdmin.php5?page=modifierIngredientsForm');

?>