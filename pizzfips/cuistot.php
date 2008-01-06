<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Crepaiolo pro</title>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
		<META HTTP-EQUIV="Refresh" CONTENT="300;URL=cuistot.php"> 
    </head>
    <body>
		<script type="text/javascript">
			function pret(commande, item, pret){
				//alert(item);
				p=1;
				if (pret==1) p=0;
				window.location.href = 'cuistot/itempret.php?commande='+commande+'&item='+item+'&pret='+p;
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
				echo "<h2 onclick=\"livrer('".$idCommande."')\">Commande $i</h2>";
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
				$res3 = queryDB("SELECT item, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0) {
					echo "!!! Aucun item commandé !!!<br/>";
				}
				else {
					$j=0;
					while($row3){
						$item = $row3["item"];
						$quantite = $row3["quantite"];
						$pret = $row3["pret"];
						if ($pret) {
							$couleur = "gray";
						}
						else {
							$couleur = "black";
						}
						echo "<h4 style='color:".$couleur."' onclick=\"pret('".$idCommande."','".$item."','".$pret."')\">$quantite x $item</h4>";
						$trouve = 0;
						// fichier xml
						$dom_object = new DomDocument();
						$dom_object->load("xml/nouriture.xml");
						$xpath = new Domxpath($dom_object);
						// crepe predefinie
						$result = $xpath->query("//Crepe[Nom='$item']/Ingredients/Ingredient");
						if ($result->length != 0) {
							$trouve++;
							echo "<em style='color:".$couleur."'>Crêpe standard</em><br/>";
							foreach ($result as $ing) {
							    echo "<div style='color:".$couleur."'>".$ing->nodeValue."</div>";   
							}
						}
						// galette predefinie
						$result = $xpath->query("//Galette[Nom='$item']/Ingredients/Ingredient");
						if ($result->length != 0) {
							$trouve++;
							echo "<em style='color:".$couleur."'>Galette standard</em><br/>";
							foreach ($result as $ing) {
							    echo "<div style='color:".$couleur."'>".$ing->nodeValue."</div>"; 
							}
						}
						// crepe perso
						$res4 = queryDB("SELECT ingredient FROM crepesperso WHERE crepeperso='".$item."'", 'select');
						$row4 = mysql_fetch_assoc($res4);
						if ($row4 != 0) {
							$trouve++;
							echo "<em style='color:".$couleur."'>Crêpe perso</em><br/>";
							$k=0;
							while($row4){
								$ingredient = $row4["ingredient"];
								echo "<div style='color:".$couleur."'>".$ingredient."</div>";
								$row4 = mysql_fetch_assoc($res4);
								$k++;
							}
						}
						// boisson
						$result = $xpath->query("//Boisson[Nom='$item']");
						if ($result->length != 0) {
							$trouve++;
							echo "<em style='color:".$couleur."'>Boisson</em><br/>";
						}
						// autre dessert
						$result = $xpath->query("//Dessert[Nom='$item']");
						if ($result->length != 0) {
							$trouve++;
							echo "<em style='color:".$couleur."'>Dessert</em><br/>";
						}
						// si pas trouvé
						if ($trouve==0) {
							echo "<div style='color:red'>!!! Item introuvable !!!<br/></div>";
						}
						else if ($trouve>1) {
							echo "<div style='color:red'>!!! Plusieurs items correspondant !!!<br/></div>";
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
				}
				$row = mysql_fetch_assoc($res);
				$i++;
			}
			echo "<br/><br/><font size=1>Dernière mise à jour le ".date("d-m-Y")." à ".date("H:i:s")."</font>";
			function datefr($date) { 
				$split = split("-",$date); 
				$annee = $split[0]; 
				$mois = $split[1]; 
				$jour = $split[2]; 
				return "$jour"."-"."$mois"."-"."$annee"; 
			}
		?>
    </body>
</html>