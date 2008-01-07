<?php
 	require('outils/outilsBD.php');
 	echo ("<div class=\"title\">Recherche</div>");
	echo ("Ingredients<form name = 'formRecherche' action='index.php5?page=recherche' method='post'> <select name='choix'>");
	
	$res1 = queryDB("SELECT ingredient FROM stocks WHERE crepable = 1", 'select');
	$row1 = mysql_fetch_assoc($res1);
	if ($row1 == 0) {
		echo "Aucune";
	}
	while($row1){
		echo "<option value='".$row1["ingredient"]."'>".$row1["ingredient"]."</option>";
		$row1 = mysql_fetch_assoc($res1);
		}
	echo ("</select><input type='submit' value='rechercher' /></form>");
	if(!empty($_POST['choix']))
	{
		echo "<div class='title'>Résultats sur l'ingredient : ".$_POST['choix']." </div>";
		$xml = new DOMDocument;
		$xml->load("xml/nourriture.xml");
		
		$xsl = new DOMDocument;
		$xsl->load("xslt/AffResultat.xsl");
		
		// Configuration du transformateur
		$proc = new XSLTProcessor;
		$proc->setParameter('','choix',$_POST['choix']);
		$proc->importStyleSheet($xsl); // attachement des règles xsl
		
		$res=$proc->transformToXML($xml);
		print "$res";
	} 
?>