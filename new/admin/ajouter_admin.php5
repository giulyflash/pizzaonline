<?php
	$dom->load('xml/nourriture.xml');
	
	if(empty($_POST['type']) || empty($_POST['ingredient']))
	{
		echo '<div class="title">Erreur</div>Erreur dans l\'ajout.';
	}
	else
	{
		$racine = $dom->documentElement;
		$id = $dom->getElementByTagName($_POST['type'])->length + 1;
		$nom="";
		foreach ($_POST['ingredient'] as $ingredient)
		{
			$nom=$nom.$ingredient." ";
		}
		$type_xml = $dom->createElement($_POST['type']);
		$type_xml->setAttribute("id",$id);
		
		$nom_xml = $dom->createElement("Nom");
		$nom_xml_text = $dom->createTextNode($nom);
		$nom_xml->appendChild ($nom_xml_text);
		$type_xml->appendChild ($nom_xml);
		
		$prix_xml = $dom->createElement("Prix");
		$prix_xml_text = $dom->createTextNode($_POST['prix']);
		$prix_xml->appendChild ($prix_xml_text);
		$type_xml->appendChild ($prix_xml);
		
		$ingredients_xml = $dom->createElement("Ingredients");

		foreach ($_POST['ingredient'] as $ingredient)
		{
			$ingredient_xml = $dom->createElement("Ingredient");
			$ingredient_xml_text = $dom->createTextNode($ingredient);
			$ingredient_xml->appendChild ($ingredient_xml_text);
			$ingredients_xml->appendChild ($ingredient_xml);
		}
		$type_xml->appendChild ($ingredients_xml);
		$racine->appendChild ($type_xml);

	}
	
	$dom->save('xml/nourriture2.xml');

?>

