<div class="title">Nos menu</div>
<!-- Affichages de Confirmation -->
<?php
if($_POST['send']==1 ){
    //$requete2 = "INSERT INTO `ind_secteurs` (Industries,secteurActivite) VALUES (".$_ENV['ind'].",".$_ENV['sect'].");";
    //$result2 = requete_SQL($requete2);	
    echo "<br><div id='resultat'>&nbsp;La commande a bien été ajoutée.<br></div><br>";
 }
?>
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
		$prixmenu = $menu->getElementsByTagName('Prix')->item(0);
		echo "<table>";
		echo "<form action='".$_SERVER['PHP_SELF']."?page=menu' method='post'> ";
		echo "<tr><td> Menu ".$nommenu->nodeValue. "</td></tr>";
		echo"<tr><td>";
		if (is_object($Galettemenu)) {
			for($i=0;$i<$Galettemenu->nodeValue;$i++){
				echo " Galette ".($i+1).": <select name='galette".($i+1)."' id='galette".($i+1)."' size=1 >"; $id_galette=selectItem($listeGalettes,1); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo"<tr><td>";
		if (is_object($Crepemenu)) {
			for($i=0;$i<$Crepemenu->nodeValue;$i++){
				echo " Crepe ".($i+1).": <select name='crepe".($i+1)."' id='crepe".($i+1)."' size=1 >"; $id_crepe=selectItem($listeCrepes,1); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo"<tr><td>";
		if (is_object($Boissonmenu)) {
			for($i=0;$i<$Boissonmenu->nodeValue;$i++){
				echo " Boisson ".($i+1).": <select name='boisson".($i+1)."' id='boisson".($i+1)."' size=1 >"; $id_boisson=selectItem($listeBoissons,1); 
				echo "</select>";
			}
		}
		echo"</td></tr>";
		echo "<tr><td> Prix ".$prixmenu->nodeValue. "</td></tr>";
		echo "<input type='hidden' name='prix' value='".$prixmenu->nodeValue. "' />";
		echo "<input type='hidden' name='send' value='1' />";
		echo "<tr><td> Quantite <input type='text' name='quantite' id='quantite' value='1' /> Commander <input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'></td></tr>";
		echo"</form></table>";
	}

?>
