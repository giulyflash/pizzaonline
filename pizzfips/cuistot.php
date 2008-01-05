<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Crepaiolo pro</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    </head>
    <body>
        <?php
			echo ("Liste des commandes en cours<br/><br/>");
			require('outils/outilsBD.php');
			
			$res = queryDB("SELECT * FROM commandes where livre=0", 'select');
			$i=1;
			$row = mysql_fetch_assoc($res);
			if ($row == 0) {
				echo "Aucune :)<br/>";
			}
			while($row){
				echo "Commande $i<br/>";
				$idCommande = $row["id"];
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
				echo "Commande passée le $date à $heure<br/>";
				// items
				$res3 = queryDB("SELECT item, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0) {
					echo "!!! Aucun item commandé !!!<br/>";
				}
				else {
					$j=0;
					echo "<br/>";
					while($row3){
						$item = $row3["item"];
						$quantite = $row3["quantite"];
						$pret = $row3["pret"];
						echo "$quantite x $item<br/>";
						$trouve = 0;
						// fichier xml
						$dom_object = new DomDocument();
						$dom_object->load("xml/nouriture.xml");
						$xpath = new Domxpath($dom_object);
						// crepe predefinie
						$result = $xpath->query("//Crepe[Nom='$item']/Ingredients/Ingredient");
						if ($result->length != 0) {
							$trouve++;
							echo "Ingredients :<br/>";
							foreach ($result as $ing) {
							    echo $ing->nodeValue."<br/>";   
							}
						}
						// galette predefinie
						$result = $xpath->query("//Galette[Nom='$item']/Ingredients/Ingredient");
						if ($result->length != 0) {
							$trouve++;
							echo "Ingredients :<br/>";
							foreach ($result as $ing) {
							    echo $ing->nodeValue."<br/>";   
							}
						}
						// crepe perso
						$res4 = queryDB("SELECT ingredient FROM crepesperso WHERE crepeperso='".$item."'", 'select');
						$row4 = mysql_fetch_assoc($res4);
						if ($row4 != 0) {
							$trouve++;
							echo "Ingredients (crepe perso) :<br/>";
							$k=0;
							while($row4){
								$ingredient = $row4["ingredient"];
								echo $ingredient."<br/>";
								$row4 = mysql_fetch_assoc($res4);
								$k++;
							}
						}
						// boisson
						$result = $xpath->query("//Boisson[Nom='$item']");
						if ($result->length != 0) {
							$trouve++;
							echo $result->firstchild->nodeValue."<br/>";
						}
						// autre dessert
						$result = $xpath->query("//Dessert[Nom='$item']");
						if ($result->length != 0) {
							$trouve++;
							echo $result->firstchild->nodeValue."<br/>";
						}
						// si pas trouvé
						if ($trouve==0) {
							echo "!!! Item introuvable !!!<br/>";
						}
						else if ($trouve>1) {
							echo "!!! Plusieurs items correspondant !!!<br/>";
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
						echo "<br/>";
					}
				}
				echo "<br/>";
				$row = mysql_fetch_assoc($res);
				$i = $i+1;
			}
		?>
    </body>
</html>