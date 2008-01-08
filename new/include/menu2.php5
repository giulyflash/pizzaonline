
<div class="title">Nos menu</div>
<?php
 	include_once 'fonctions.php5';
	
	
	$xml = new DOMDocument;
	$xml->load("xml/menus.xml");
	
	$Nouriturexml = new DOMDocument;
	$Nouriturexml->load("xml/nourriture.xml");
	
	$listeMenus = $xml->getElementsByTagName('Menu');
	$listeGalettes = $Nouriturexml->getElementsByTagName('Galette');
	$listeCrepes = $Nouriturexml->getElementsByTagName('Crepe');
	$listeDesserts = $Nouriturexml->getElementsByTagName('Dessert');
	$listeBoissons = $Nouriturexml->getElementsByTagName('Boisson');
	
	foreach($listeMenus as $menu){
		$nommenu = $menu->getElementsByTagName('Nom')->item(0);
		$Galettemenu = $menu->getElementsByTagName('Galette')->item(0);
		$Crepemenu = $menu->getElementsByTagName('Crepe')->item(0);
		$Dessertmenu = $menu->getElementsByTagName('Dessert')->item(0);
		$Boissonmenu = $menu->getElementsByTagName('Boisson')->item(0);
		$prixmenu = $menu->getElementsByTagName('Prix')->item(0);
		$idmenu ="";
		echo "<table>";
		echo "<form name ='ff' action='index.php5?page=ajouter_menu' method='post'> ";
		echo "<input type='hidden' name='nommenu' value='".$nommenu->nodeValue. "' />";
		echo "<tr><th> Menu ".$nommenu->nodeValue. " ".$prixmenu->nodeValue. " euros</th></tr>";
		echo"<tr><td>";
		if (is_object($Galettemenu)) {
			echo "<input type='hidden' name='nbgalette' value='".$Galettemenu->nodeValue. "' />";
			for($i=0;$i<$Galettemenu->nodeValue;$i++){
				echo " Galette ".($i+1).": <select name='galette".($i+1)."' id='galette".($i+1)."'  >"; selectItem($listeGalettes,0); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo"<tr><td>";
		if (is_object($Crepemenu)) {
			echo "<input type='hidden' name='nbcrepe' value='".$Crepemenu->nodeValue. "' />";
			for($i=0;$i<$Crepemenu->nodeValue;$i++){
				echo " Crêpe ".($i+1).": <select name='crepe".($i+1)."' id='crepe".($i+1)."'  >"; selectItem($listeCrepes,"0"); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo"<tr><td>";
		if (is_object($Dessertmenu)) {
			echo "<input type='hidden' name='nbdessert' value='".$Dessertmenu->nodeValue. "' />";
			for($i=0;$i<$Dessertmenu->nodeValue;$i++){
				echo " Dessert ".($i+1).": <select name='dessert".($i+1)."' id='dessert".($i+1)."'  >"; selectItem($listeDesserts,"0"); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo"<tr><td>";
		if (is_object($Boissonmenu)) {
			echo "<input type='hidden' name='nbboisson' value='".$Boissonmenu->nodeValue. "' />";
			for($i=0;$i<$Boissonmenu->nodeValue;$i++){
				echo " Boisson ".($i+1).": <select name='boisson".($i+1)."' id='boisson".($i+1)."'  >"; selectItem($listeBoissons,"0"); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo "<input type='hidden' name='prix' value='".$prixmenu->nodeValue. "' />";
		echo "<input type='hidden' name='send' value='1' />";
		echo "<tr><td> ".$idmenu." Quantité <input type='text' name='quantite' id='quantite' value='1' /> Commander <input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'></td></tr>";
		echo"</form></table>";
	}

	/*
	$xsl = new DOMDocument;
	$xsl->load("xslt/AffMenu.xsl");
	
	// Configuration du transformateur
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl); // attachement des règles xsl
	
	$res=$proc->transformToXML($xml);
	print "$res";*/
?>
