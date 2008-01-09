<b class="title">Nos menus</b>
<?php
 	include_once 'fonctions.php5';
	
	$xml = new DOMDocument;
	$xml->load("xml/menus.xml");
	
	$Nouriturexml = new DOMDocument;
	$Nouriturexml->load("xml/nourriture.xml");
	
	$listeMenus = $xml->getElementsByTagName('Menu');
	$listeGalettes = $Nouriturexml->getElementsByTagName('Galette');
	$listeCrepes = $Nouriturexml->getElementsByTagName('Crepe');
	$listeBoissons = $Nouriturexml->getElementsByTagName('Boisson');
	
	foreach($listeMenus as $menu){
		$nommenu = $menu->getElementsByTagName('Nom')->item(0);
		$Galettemenu = $menu->getElementsByTagName('Galette')->item(0);
		$Crepemenu = $menu->getElementsByTagName('Crepe')->item(0);
		$Boissonmenu = $menu->getElementsByTagName('Boisson')->item(0);
		$Dessertmenu = $menu->getElementsByTagName('Dessert')->item(0);
		$prixmenu = $menu->getElementsByTagName('Prix')->item(0);
		$idmenu ="";
		echo "<table>";
		echo "<tr><td><i>Menu ".$nommenu->nodeValue. " ".$prixmenu->nodeValue. " euros</i></td></tr>";
		if ($Galettemenu != NULL) {
			echo"<tr><td>";
			echo $Galettemenu->nodeValue." Galette";
			if ($Galettemenu->nodeValue > 1) {
				echo "s";
			}
			echo"</td></tr>";
		}
		if ($Crepemenu != NULL) {
			echo"<tr><td>";
			echo $Crepemenu->nodeValue." Crepe";
			if ($Crepemenu->nodeValue > 1) {
				echo "s";
			}
			echo"</td></tr>";
		}
		if ($Boissonmenu != NULL) {
			echo"<tr><td>";
			echo $Boissonmenu->nodeValue." Boisson";
			if ($Boissonmenu->nodeValue > 1) {
				echo "s";
			}
			echo"</td></tr>";
		}
		if ($Dessertmenu != NULL) {
			echo"<tr><td>";
			echo $Dessertmenu->nodeValue." Dessert";
			if ($Dessertmenu->nodeValue > 1) {
				echo "s";
			}
			echo"</td></tr>";
		}
		echo"</table>";
		echo "<br/>";
	}

?>
