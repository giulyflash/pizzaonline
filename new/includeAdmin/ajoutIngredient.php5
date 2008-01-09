 <?php
 	require('outils/outilsBD.php');
	$ingredient = "";
	$quantite = -1;
	$seuil = -1;
	$crepable = -1;
	$prix = -1;
	$sucresale = -1;
	$type = "";
	
	if(empty( $_POST['nom'])) echo "le nom n'est pas rensigné";
	else $ingredient = $_POST['nom'];	
	
	if(empty($_POST['prix']) || $_POST['prix'] < 0) echo "le prix doit être renseigné et ne peut être négatif <br/>"; 
	else $prix = $_POST['prix'];
	
	if(empty($_POST['seuil']) || $_POST['seuil'] < 0) echo "le seuil doit être renseigné et ne peut être négatif <br/> "; 
	else $seuil = $_POST['seuil'];
	
	if(empty($_POST['quantite']) || $_POST['quantite'] < 0) echo "la quantité doit être renseignée et ne peut être négative <br/>"; 
	else $quantite = $_POST['quantite'];
	
	$type = $_POST['type'];
	
	if($type == "Ingredient")
	{
		$crepable = 1;
		$options = $_POST['optionSaveur'];
		$options_text = implode(', ',$options);
		if(empty($options_text)) echo "Pour un ingredient au moins une saveur doit être renseigné <br/>";
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
		if($ingredient != "" && $quantite != -1 && $seuil != -1 && $crepable != -1 && $prix != -1 && $surcesale != -1 && $_POST['type'] != "Autre")
		{
			$dom = new DomDocument();
			$dom->load('xml/nourriture.xml');
			$xpath = new Domxpath($dom);
			
			$racine = $dom->documentElement;
			$nom = $ingredient;
			
			$result = $xpath->query("//$type [Nom='$nom']");
			
			if ($result->length == 0) 
			{
				$type_xml = $dom->createElement($type);
				
				$nom_xml = $dom->createElement("Nom");
				$nom_xml_text = $dom->createTextNode($nom);
				$nom_xml->appendChild ($nom_xml_text);
				$type_xml->appendChild ($nom_xml);
				
				$prix_xml = $dom->createElement("Prix");
				$prix_xml_text = $dom->createTextNode($prix);
				$prix_xml->appendChild ($prix_xml_text);
				$type_xml->appendChild ($prix_xml);
		
				$racine->appendChild ($type_xml);
				echo ($type." ".$nom." ajoutée au fichier xml avec un prix de ".$prix."€ <br/>");
				$dom->save('xml/nourriture.xml');
			}
			else
			{
				echo '<div class="title">Erreur</div>'.$type." ".$nom." déja présente dans le fichier <br/>";
			}	
		}
	}
	
	 
	if($ingredient != "" && $quantite != -1 && $seuil != -1 && $crepable != -1 && $prix != -1 && $surcesale != -1 ) {
		$query = "INSERT IF NOT EXISTS INTO stocks (ingredient,quantite,seuil,crepable,prix,sucresale) VALUES('".$ingredient."',".$quantite.",".$seuil.",".$crepable.",".$prix.",".$sucresale.")";
		$result = queryDB($query, 'insert');
		echo $result;
		echo $query;
		echo ($quantite." ".$type." ".$ingredient." ajoutée a la base avec un prix de ".$prix."€ et un seuil de ".$seuil."<br/>");
	}
	echo '<br /><a href="indexAdmin.php5?page=modifierIngredientsForm">Retour</a>';

?>