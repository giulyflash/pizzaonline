
<?php
	require('outils/outilsBD.php');
	require('fonctions.php5');
	
	$idCommande = $_GET['idcommande'];
	$res = queryDB("SELECT * FROM commandes WHERE id=".$idCommande." ORDER BY date, heure", 'select');
	$row = mysql_fetch_assoc($res);
	$date = $row["date"];
	echo "Commande passée le ".datefr($date)." <br/>";
?>
<div class="title">Vos articles</div>
<?php
				// items
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0) {
					echo "!!! Aucun item commandé !!!<br/>";
				}else {
					$j=0;
					
					echo '<table>
							<tr>
								<th>
									Type
								</th>
								<th>
									Description
								</th>
								<th>
									Prix
								</th>
								<th>
									Quantite
								</th>
								<th>
									Commander
								</th>
							</tr>';
					while($row3){
						if($row3["type"] != "Menu"){
							$item = $row3["item"];
							$quantite = $row3["quantite"];
							$trouve = 0;
							// fichier xml
							$dom_object = new DomDocument();
							$dom_object->load("xml/nourriture.xml");
							$xpath = new Domxpath($dom_object);
							// galette predefinie
							$result = $xpath->query("//Galette[@id='$item']/Nom");
							$prix = $xpath->query("//Galette[@id='$item']/child::Prix[position()=1]");
							//$id = $xpath->query("//Galette[Nom='$item']/@id");
							if ($result->length != 0) {
								$trouve++;
								foreach ($result as $ing) {
									echo "<tr><td>Galette</td>";
									echo "<td>".$ing->nodeValue."</td>"; 
									//echo "<td>".$prix->nodeValue."</td>"; 
									echo "<td>?</td>"; 
									echo "<td>".$quantite."</td>"; 
									echo "<td>
									<form action='index.php5?page=ajouter_article' method='post'>
									<input type='hidden' name='type' value='galette' />
									<input type='hidden' name='description' value='".$ing->nodeValue."' />
									<input type='hidden' name='id' value='".$item."' />
									<input type='hidden' name='prix' value='' />
									<input type='text' name='quantite' value='1' />
									<input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'>
									</form>	</td></tr>";
								}
							}
							// crepe predefinie
							$result = $xpath->query("//Crepe[Nom='$item']/Prix");
							$id = $xpath->query("//Crepe[Nom='$item']/@id");
							if ($result->length != 0) {
								$trouve++;
								foreach ($result as $ing) {
									echo "<tr><td>Crêpe</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>"; 
								}
							}
							// boisson
							$result = $xpath->query("//Boisson[Nom='$item']/Prix");
							$id = $xpath->query("//Boisson[Nom='$item']/@id");
							if ($result->length != 0) {
								$trouve++;
								foreach ($result as $ing) {
									echo "<tr><td>Boisson</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>"; 
								}
							}
							// autre dessert
							$result = $xpath->query("//Dessert[Nom='$item']/Prix");
							$id = $xpath->query("//Dessert[Nom='$item']/@id");
							if ($result->length != 0) {
								$trouve++;
								foreach ($result as $ing) {
									echo "<tr><td>Dessert</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>"; 
								}
							}
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<div class="title">Vos menu</div>
<?php
				// menus
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 != 0 ) {
					$j=0;
					while($row3){
						if($row3["type"] == "Menu"){
							$idmenu = $row3["item"];
							$res4 = queryDB("SELECT type FROM menus WHERE id=".intval($idmenu), 'select');
							$row4 = mysql_fetch_assoc($res4);
							if ($row4 != 0) {
								echo '<table>';
								echo '<tr>
									<th>
										Menu '.$row4['type'].'
									</th>
									<th>
										Prix ?
									</th>
								</tr>';
								$res5 = queryDB("SELECT type, item, pret FROM itemsmenus WHERE idmenu=".$idmenu, 'select');
								$row5 = mysql_fetch_assoc($res5);
								while($row5){
									$item = $row5["item"];
									$type = $row5["type"];
									$trouve = 0;
									// fichier xml
									/*$dom_object = new DomDocument();
									$dom_object->load("xml/nourriture.xml");
									$xpath = new Domxpath($dom_object);*/
									echo '<tr>
									<td>
										'.$type.'
									</td>
									<td>
										'.$item.'
									</td>
									</tr>';
									// item suivant
									$row5 = mysql_fetch_assoc($res5);
								}
							}
						}
						// menu suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<div class="title">Vos crepes persos</div>
<?php
				// items
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande, 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0) {
					echo "!!! Aucun item commandé !!!<br/>";
				}else {
					$j=0;
					
					echo '<table>
							<tr>
								<th>
									Type
								</th>
								<th>
									Description
								</th>
								<th>
									Prix
								</th>
								<th>
									Quantite
								</th>
								<th>
									Commander
								</th>
							</tr>';
					while($row3){
						if($row3["type"] != "Menu"){
							$item = $row3["item"];
							$quantite = $row3["quantite"];
							$trouve = 0;
							// fichier xml
							$dom_object = new DomDocument();
							$dom_object->load("xml/nourriture.xml");
							$xpath = new Domxpath($dom_object);
							// galette perso
							$res4 = queryDB("SELECT ingredient FROM ingredientsperso WHERE idperso='".$item."' AND idperso IN (SELECT idperso FROM perso WHERE sucre=0)", 'select');
							$row4 = mysql_fetch_assoc($res4);
							if ($row4 != 0) {
								$trouve++;
								$k=0;
								echo "<tr><td>Galette perso </td><td>";
								while($row4){
									$ingredient = $row4["ingredient"];
									echo $ingredient." ";
									$row4 = mysql_fetch_assoc($res4);
									$k++;
								}
								echo "</td><td>prix ?</td>"; 
								echo "<td>".$quantite."</td>"; 
								echo"</tr>"; 
							}
							// crepe perso
							$res4 = queryDB("SELECT ingredient FROM ingredientsperso WHERE idperso='".$item."' AND idperso IN (SELECT idperso FROM perso WHERE sucre=1)", 'select');
							$row4 = mysql_fetch_assoc($res4);
							if ($row4 != 0) {
								$trouve++;
								$k=0;
								echo "<tr><td>Crêpe perso </td><td>";
								while($row4){
									$ingredient = $row4["ingredient"];
									echo $ingredient." ";
									$row4 = mysql_fetch_assoc($res4);
									$k++;
								}
								echo "</td><td>prix ?</td>"; 
								echo "<td>".$quantite."</td>"; 
								echo"</tr>";
							}
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<a href='index.php5?page=historique'>Retourner à l'historique</a> <br/>