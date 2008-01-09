<script type="text/javascript">
	function livrer()
	{
		return(confirm('La commande est prête à être livrée ?'));
	}
	function RefreshPage() { 
		window.location.href = "http://localhost/new/new/indexAdmin.php5?page=commandes"; 
	} 
	setTimeout(RefreshPage, 300000); 
</script>
<?php
	require('outils/outilsBD.php');
	echo "<h1>Liste des items en pénurie</h1>";
	$res = queryDB("SELECT ingredient FROM stocks WHERE quantite < seuil", 'select');
	$i=1;
	$row = mysql_fetch_assoc($res);
	if ($row == 0) {
		echo "Aucune item en pénurie.";
	}
	while($row){
		$row = mysql_fetch_assoc($res);
	}
	echo "<h1>Liste des commandes en cours</h1>";
	$res = queryDB("SELECT * FROM commandes WHERE livre=0 ORDER BY date, heure", 'select');
	$i=1;
	$row = mysql_fetch_assoc($res);
	if ($row == 0) {
		echo "Aucune commande en cours.";
	}
	while($row){
		$idCommande = $row["id"];
		echo "<table><tr><td>";
		echo "<h2>Commande ".$i." <a href=\"includeAdmin/commandeprete.php5?id=".$idCommande."\" onclick=\"if(!livrer()) return false;\"><img src=\"interf/livrer.png\"></a></h2>";
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
			echo $prenomClient." ".$nomClient;
		}
		echo ") --- ";
		// date et heure de la commande
		$date = $row["date"];
		$heure = $row["heure"];
		echo "Commande passée le ".datefr($date)." à $heure<br/>";
		echo "</div><ul>";
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
		echo "</ul></td></tr></table>";
	}
	echo "<font size=1>Dernière mise à jour le ".date("d-m-Y")." à ".date("H:i:s")."</font>";
	function datefr($date) { 
		$split = split("-",$date); 
		$annee = $split[0]; 
		$mois = $split[1]; 
		$jour = $split[2]; 
		return $jour."-".$mois."-".$annee; 
	}
	function echoItem ($idCommande, $item, $quantite, $pret, $type, $xpath, $parent, $idmenu=''){
		$classe=($pret)?"pret":"nonpret";
		$pret=($pret==0)?"1":"0";
		$debutTitre = "<li class=\"".$classe."\">";
		$trouve = false;
		if($idmenu!='') $linkitem=$idmenu;
		else $linkitem=$item;
		// switch
		switch ($type)
		{
			case "Crepe":
				echo $debutTitre.$quantite." x ".$item;
				$result = $xpath->query("//Crepe[Nom='".$item."']/Ingredients/Ingredient");
				if ($result->length != 0)
				{
					$trouve=true;
					echo " (Crêpe standard) <a href=\"includeAdmin/itempret.php5?commande=".$idCommande."&item=".$linkitem."&pret=".$pret."&parent=".$parent."\"><img src=\"interf/livrer.png\"></a><ul>";
					foreach ($result as $ing)
					{
						echo "<li>".$ing->nodeValue."</li>";   
					}
					echo "</ul></li>";
				}
				break;
			case "Galette":
				echo $debutTitre.$quantite." x ".$item;
				$result = $xpath->query("//Galette[Nom='".$item."']/Ingredients/Ingredient");
				if ($result->length != 0) {
					$trouve=true;
					echo " (Galette standard) <a href=\"includeAdmin/itempret.php5?commande=".$idCommande."&item=".$linkitem."&pret=".$pret."&parent=".$parent."\"><img src=\"interf/livrer.png\"></a><ul>";
					foreach ($result as $ing)
					{
						echo "<li>".$ing->nodeValue."</li>"; 
					}
					echo "</ul></li>";
				}
				break;
			case "Perso":
				echo $debutTitre.$quantite." x Perso";
				$res4 = queryDB("SELECT ingredient FROM ingredientsperso WHERE idperso='".$item."'", 'select');
				$row4 = mysql_fetch_assoc($res4);
				if ($row4 != 0) {
					$trouve=true;
					$res5 = queryDB("SELECT sucre FROM perso WHERE idperso='".$item."'", 'select');
					$row5 = mysql_fetch_assoc($res5);
					$sucre = $row5["sucre"];
					echo " (".(($sucre)?"Crêpe":"Galette").") <a href=\"includeAdmin/itempret.php5?commande=".$idCommande."&item=".$linkitem."&pret=".$pret."&parent=".$parent."\"><img src=\"interf/livrer.png\"></a><ul>";
					$k=0;
					while($row4){
						$ingredient = $row4["ingredient"];
						echo "<li>".$ingredient."</li>";
						$row4 = mysql_fetch_assoc($res4);
						$k++;
					}
					echo "</ul></li>";
				}
				break;
			case "Dessert":
				echo $debutTitre.$quantite." x ".$item." (Dessert) <a href=\"includeAdmin/itempret.php5?commande=".$idCommande."&item=".$linkitem."&pret=".$pret."&parent=".$parent."\"><img src=\"interf/livrer.png\"></a>";
				$result = $xpath->query("//Dessert[Nom='".$item."']");
				if ($result->length != 0) {
					$trouve=true;
				}
				echo "</li>";
				break;
			case "Boisson":
				echo $debutTitre.$quantite." x ".$item." (Boisson) <a href=\"includeAdmin/itempret.php5?commande=".$idCommande."&item=".$linkitem."&pret=".$pret."&parent=".$parent."\"><img src=\"interf/livrer.png\"></a>";
				$result = $xpath->query("//Boisson[Nom='".$item."']");
				if ($result->length != 0) {
					$trouve=true;
				}
				echo "</li>";
				break;
			case "Menu":
				$res4 = queryDB("SELECT item, type, pret,id FROM itemsmenus WHERE idmenu=".$item, 'select');
				$row4 = mysql_fetch_assoc($res4);
				$k=0;
				while($row4){
					$trouve = true;
					echoItem ($item, $row4["item"], $quantite, $row4["pret"], $row4["type"], $xpath, "Menu", $row4["id"]);
					$row4 = mysql_fetch_assoc($res4);
					$k++;
				}
				break;
			default:
				echo $debutTitre.$quantite." x ".$item."</li>";
				echo "<div style='color:red'>!!! Item introuvable !!!</div>";
				break;
		}
		if (!$trouve) {
			echo "<div style='color:red'>!!! Item introuvable !!!</div>";
		}
	}
?>