<script type="text/javascript">
	function pret(commande, item, pret, parent){
		//alert(item);
		p=1;
		if (pret==1) p=0;
		window.location.href = 'cuistot/itempret.php?commande='+commande+'&item='+item+'&pret='+p+'&parent='+parent;
	}
	function livrer(commande){
		if (confirm('La commande est prête à être livrée ?')) {
			window.location.href = 'cuistot/commandeprete.php?id='+commande;
		}
	}
</script>
<?php
	echo ("<h1>Liste des commandes en cours</h1>");
	require('outils/outilsBD.php');
	$res = queryDB("SELECT * FROM commandes WHERE livre=0 ORDER BY date, heure", 'select');
	$i=1;
	$row = mysql_fetch_assoc($res);
	if ($row == 0) {
		echo "Aucune :)";
	}
	while($row){
		$idCommande = $row["id"];
		echo "<table><tr><td>";
		echo "<h2 onclick=\"livrer('".$idCommande."')\">Commande $i</h2>";
		echo "<div class=\"info\">";
		// client
		$client = $row["client"];
		echo "Client $client (";
		$res2 = queryDB("SELECT nom, prenom FROM client WHERE id=".$client, 'select');
		$row2 = mysql_fetch_assoc($res2);
		if ($row2 == 0) {
			echo "!!! inexistant dans la table client !!!";
		}
		else {
			$nomClient = $row2["nom"];
			$prenomClient = $row2["prenom"];
			echo "$prenomClient $nomClient";
		}
		echo ")<br/>";
		// date et heure de la commande
		$date = $row["date"];
		$heure = $row["heure"];
		echo "Commande passée le ".datefr($date)." à $heure<br/>";
		// items
		$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
		$row3 = mysql_fetch_assoc($res3);
		if ($row3 == 0) {
			echo "!!! Aucun item commandé !!!<br/>";
		}
		else {
			$j=0;
			// fichier xml
			$dom_object = new DomDocument();
			$dom_object->load("xml/nourriture.xml");
			$xpath = new Domxpath($dom_object);
			while($row3){
				$item = $row3["item"];
				$quantite = $row3["quantite"];
				$pret = $row3["pret"];
				$type = $row3["type"];
				echoItem ($idCommande, $item, $quantite, $pret, $type, $xpath, "Commande");
				// item suivant
				$row3 = mysql_fetch_assoc($res3);
				$j++;
			}
		}
		$row = mysql_fetch_assoc($res);
		$i++;
		echo "</td></tr></table>";
	}
	echo "<br/><br/><font size=1>Dernière mise à jour le ".date("d-m-Y")." à ".date("H:i:s")."</font>";
	function datefr($date) { 
		$split = split("-",$date); 
		$annee = $split[0]; 
		$mois = $split[1]; 
		$jour = $split[2]; 
		return "$jour"."-"."$mois"."-"."$annee"; 
	}
	function echoItem ($idCommande, $item, $quantite, $pret, $type, $xpath, $parent){
		if ($pret) {
			$couleur = "gray";
		}
		else {
			$couleur = "black";
		}
		$debutTitre = "<h4 style='color:".$couleur."' onclick=\"pret('".$idCommande."','".$item."','".$pret."', '".$parent."')\">";
		$trouve = false;
		// switch
		switch ($type) {
			case "Crepe":
				echo $debutTitre."$quantite x $item</h4>";
				$result = $xpath->query("//Crepe[Nom='$item']/Ingredients/Ingredient");
				if ($result->length != 0) {
					$trouve=true;
					echo "<em style='color:".$couleur."'>Crêpe standard</em><br/>";
					foreach ($result as $ing) {
						echo "<div style='color:".$couleur."'>".$ing->nodeValue."</div>";   
					}
				}
				break;
			case "Galette":
				echo $debutTitre."$quantite x $item</h4>";
				$result = $xpath->query("//Galette[Nom='$item']/Ingredients/Ingredient");
				if ($result->length != 0) {
					$trouve=true;
					echo "<em style='color:".$couleur."'>Galette standard</em><br/>";
					foreach ($result as $ing) {
						echo "<div style='color:".$couleur."'>".$ing->nodeValue."</div>"; 
					}
				}
				break;
			case "Perso":
				echo $debutTitre."$quantite x Perso</h4>";
				$res4 = queryDB("SELECT ingredient FROM ingredientsperso WHERE idperso='".$item."'", 'select');
				$row4 = mysql_fetch_assoc($res4);
				if ($row4 != 0) {
					$trouve=true;
					$res5 = queryDB("SELECT sucre FROM perso WHERE idperso='".$item."'", 'select');
					$row5 = mysql_fetch_assoc($res5);
					$sucre = $row5["sucre"];
					if ($sucre) {
						echo "<em style='color:".$couleur."'>Crêpe perso</em><br/>";
					}
					else {
						echo "<em style='color:".$couleur."'>Galette perso</em><br/>";
					}
					$k=0;
					while($row4){
						$ingredient = $row4["ingredient"];
						echo "<div style='color:".$couleur."'>".$ingredient."</div>";
						$row4 = mysql_fetch_assoc($res4);
						$k++;
					}
				}
				break;
			case "Dessert":
				echo $debutTitre."$quantite x $item</h4><em style='color:".$couleur."'>Dessert</em><br/>";
				$result = $xpath->query("//Dessert[Nom='$item']");
				if ($result->length != 0) {
					$trouve=true;
				}
				break;
			case "Boisson":
				echo $debutTitre."$quantite x $item</h4><em style='color:".$couleur."'>Boisson</em><br/>";
				$result = $xpath->query("//Boisson[Nom='$item']");
				if ($result->length != 0) {
					$trouve=true;
				}
				break;
			case "Menu":
				$res4 = queryDB("SELECT item, type, pret FROM itemsmenus WHERE idmenu=".$item, 'select');
				$row4 = mysql_fetch_assoc($res4);
				$k=0;
				while($row4){
					$trouve = true;
					echoItem ($idCommande, $row4["item"], $quantite, $row4["pret"], $row4["type"], $xpath, "Menu");
					$row4 = mysql_fetch_assoc($res4);
					$k++;
				}
				break;
			default:
				echo $debutTitre."$quantite x $item</h4>";
				echo "<div style='color:red'>!!! Item introuvable !!!<br/></div>";
				break;
		}
		if (!$trouve) {
			echo "<div style='color:red'>!!! Item introuvable !!!<br/></div>";
		}
	}
?>