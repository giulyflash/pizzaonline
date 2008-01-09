<?php
	$dom = new DomDocument();
    $dom->load('../xml/nourriture.xml');
	$xpath = new Domxpath($dom);
	$typeItem = $_POST['typeItem'];
	$nom = $_POST['nomItem'];
	$racine = $dom->documentElement;
	$result = $xpath->query("//$typeItem [Nom='$nom']");

	if ($result->length != 0) 
	{
		foreach ($result as $ing) 
		{
				$racine->removeChild($ing);  
		}
	}
	$dom->save('../xml/nourriture.xml');
	header('location:../indexAdmin.php5?page=modifierSupprimerCrepes');
?>