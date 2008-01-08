<div class="title">Nos menu</div>
<?php
 	include_once 'fonctions.php5';
	
	$xml = new DOMDocument;
	$xml->load("xml/menus.xml");
	
	$Nouriturexml = new DOMDocument;
	$Nouriturexml->load("xml/nouriture.xml");
	
	$listeMenus = $xml->getElementsByTagName('Menu');
	$listeGalettes = $Nouriturexml->getElementsByTagName('Galette');
	$listeCrepes = $Nouriturexml->getElementsByTagName('Crepe');
	$listeBoissons = $Nouriturexml->getElementsByTagName('Boisson');

	foreach($listeMenus as $menu){
	$nommenu = $menu->getElementsByTagName('Nom')->item(0);
	$Galettemenu = $menu->getElementsByTagName('Galette')->item(0);
	$Crepemenu = $menu->getElementsByTagName('Crepe')->item(0);
	$Boissonmenu = $menu->getElementsByTagName('Boisson')->item(0);
	$prixmenu = $menu->getElementsByTagName('Prix')->item(0);
	echo "<table>";
	echo "<tr><td> Menu ".$nommenu->nodeValue. "</td></tr>";
	echo"<tr><td>";
	for($i=0;$i<$Galettemenu->nodeValue;$i++){
		echo " Galette ".($i+1).": <select name='crepes' id='crepe' size=1 >"; $id_galette=selectItem($listeGalettes,1); 
		echo "</select>";
	}
	echo"</td></tr>";
	echo"<tr><td>";
	for($i=0;$i<$Crepemenu->nodeValue;$i++){
		echo " Crepe ".($i+1).": <select name='crepes' id='crepe' size=1 >"; $id_crepe=selectItem($listeCrepes,1); 
		echo "</select>";
	}
	echo"</td></tr>";
	echo"<tr><td>";
	for($i=0;$i<$Boissonmenu->nodeValue;$i++){
		echo " Boisson ".($i+1).": <select name='crepes' id='crepe' size=1 >"; $id_boisson=selectItem($listeBoissons,1); 
		echo "</select>";
	}
	echo"</td></tr>";
	echo "<tr><td> Prix ".$prixmenu->nodeValue. "</td></tr>";
	echo "<tr><td> Quantite <input type='text' name='quantite_1' id='quantite_1' value='1' /> Commander <img src='interf/panier.gif' /></td></tr>";
	echo"</table>";
	}

	
	$xsl = new DOMDocument;
	$xsl->load("xslt/AffMenu.xsl");
	
	// Configuration du transformateur
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl); // attachement des règles xsl
	
	$res=$proc->transformToXML($xml);
	print "$res";
?>
