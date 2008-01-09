
<?php
	require('outils/outilsBD.php');
	require('fonctions.php5');
	
	$idCommande = $_GET['idcommande'];
	$res = queryDB("SELECT * FROM commandes WHERE id=".$idCommande." ORDER BY date, heure", 'select');
	$row = mysql_fetch_assoc($res);
	$date = $row["date"];
	echo "Commande passée le ".datefr($date)." <br/>";
?>
<h1>Vos articles</h1>
<?php
				// fichier xml
				$dom_object = new DomDocument();
				$dom_object->load("xml/nourriture.xml");
				$xpath = new Domxpath($dom_object);
				
				$dom_object2 = new DomDocument();
				$dom_object2->load("xml/menus.xml");
				$xpath2 = new Domxpath($dom_object2);
				
				// items
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande." AND type<>'Perso' AND type<>'Menu'", 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0)
				{
					echo "Aucun article commandé dans cette commande<br/>";
				}
				else
				{
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
					while($row3)
					{
						$item = $row3["item"];
						$quantite = $row3["quantite"];
						$trouve = 0;
						
						switch ($row3["type"])
						{
							case "Galette":
							// galette predefinie
							$result=$xpath->query("//Galette[Nom='$item']/Prix");
							if ($result->length != 0)
							{
								foreach ($result as $ing)
								{
									echo "<tr><td>Galette</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>";
									echo "<td>
									<form action='index.php5?page=ajouter_article' method='post'>
									<input type='hidden' name='type' value='Galette' />
									<input type='hidden' name='description' value='".$item."' />
									<input type='hidden' name='id' value='".$item."' />
									<input type='hidden' name='prix' value='".$ing->nodeValue."' />
									<input type='text' name='quantite' value='".$quantite."' />
									<input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'>
									</form>	</td></tr>";
								}
							}
							break;
							
							case "Crepe":
							// crepe predefinie
							$result = $xpath->query("//Crepe[Nom='$item']/Prix");
							if ($result->length != 0) {
								foreach ($result as $ing) {
									echo "<tr><td>Crêpe</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>"; 
									echo "<td>
									<form action='index.php5?page=ajouter_article' method='post'>
									<input type='hidden' name='type' value='Crepe' />
									<input type='hidden' name='description' value='".$item."' />
									<input type='hidden' name='id' value='".$item."' />
									<input type='hidden' name='prix' value='".$ing->nodeValue."' />
									<input type='text' name='quantite' value='".$quantite."' />
									<input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'>
									</form>	</td></tr>";
								}
							}
							break;
							
							// boisson
							case "Boisson":
							$result = $xpath->query("//Boisson[Nom='$item']/Prix");
							if ($result->length != 0) {
								foreach ($result as $ing) {
									echo "<tr><td>Boisson</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>";
									echo "<td>".$quantite."</td>";
									echo "<td>
									<form action='index.php5?page=ajouter_article' method='post'>
									<input type='hidden' name='type' value='Boisson' />
									<input type='hidden' name='description' value='".$item."' />
									<input type='hidden' name='id' value='".$item."' />
									<input type='hidden' name='prix' value='".$ing->nodeValue."' />
									<input type='text' name='quantite' value='".$quantite."' />
									<input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'>
									</form>	</td></tr>";
								}
							}
							break;
							
							// Dessert
							case "Dessert":
							$result = $xpath->query("//Dessert[Nom='$item']/Prix");
							$id = $xpath->query("//Dessert[Nom='$item']/@id");
							if ($result->length != 0) {
								foreach ($result as $ing) {
									echo "<tr><td>Dessert</td>";
									echo "<td>".$item."</td>"; 
									echo "<td>".$ing->nodeValue."</td>"; 
									echo "<td>".$quantite."</td>"; 
									echo "<td>
									<form action='index.php5?page=ajouter_article' method='post'>
									<input type='hidden' name='type' value='Boisson' />
									<input type='hidden' name='description' value='".$item."' />
									<input type='hidden' name='id' value='".$item."' />
									<input type='hidden' name='prix' value='".$ing->nodeValue."' />
									<input type='text' name='quantite' value='".$quantite."' />
									<input type='image' src='interf/panier.gif' border='0' name='submit' alt='Go'>
									</form>	</td></tr>";
								}
							}
							break;
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<h1>Vos menu</h1>
<?php
				// menus
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande." AND type='Menu'", 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0 )
				{
					echo "Aucun menu commandé dans cette commande<br/>";
				}
				else
				{
					$j=0;
					while($row3)
					{
						$idmenu = $row3["item"];
						
						$res4 = queryDB("SELECT type FROM menus WHERE id=".intval($idmenu), 'select');
						$row4 = mysql_fetch_assoc($res4);
						if ($row4 != 0) {
						
						// Calcul de prix du menu
							$result=$xpath2->query("//Menu[Nom='".$row4['type']."']/Prix");
							if ($result->length != 0)
							{
								foreach ($result as $ing)
								{
									$prix_menu=$ing->nodeValue;
								}
							}
							echo '<table>';
							echo '<tr>
								<th>
									Menu '.$row4['type'].'
								</th>
								<th>
									Prix '.$prix_menu.'
								</th>
							</tr>';
							$res5 = queryDB("SELECT type, item, pret FROM itemsmenus WHERE idmenu=".$idmenu, 'select');
							$row5 = mysql_fetch_assoc($res5);
							while($row5){
								$item = $row5["item"];
								$type = $row5["type"];
								$trouve = 0;
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
						// menu suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<h1>Vos crepes persos</h1>
<?php
				// items
				$res3 = queryDB("SELECT item, type, quantite, pret FROM itemscommandes WHERE commande=".$idCommande." AND type='Perso'", 'select');
				$row3 = mysql_fetch_assoc($res3);
				if ($row3 == 0) {
					echo "Aucune crêpe personnalisée commandée dans cette commande<br/>";
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
					while($row3)
					{
						$item = $row3["item"];
						$quantite = $row3["quantite"];
						$trouve = 0;
						// galette perso
						$res4 = queryDB("SELECT ingredientsperso.ingredient,prix,sucre FROM ingredientsperso,stocks,perso WHERE ingredientsperso.idperso='".$item."' AND stocks.ingredient=ingredientsperso.ingredient AND ingredientsperso.idperso=perso.idperso", 'select');
						$row4 = mysql_fetch_assoc($res4);
						
						if ($row4 != 0)
						{
							$sucre=$row4['sucre'];
							$prix_perso=0;
							echo "<tr><td>".(($sucre)?"Crêpe":"Galette")." perso </td><td>";
							while($row4)
							{
								$ingredient=$row4["ingredient"];
								$prix_perso+=$row4["prix"];
								echo $ingredient." ";
								$row4 = mysql_fetch_assoc($res4);
							}
							echo "</td><td>prix ".$prix_perso."</td>"; 
							echo "<td>".$quantite."</td>"; 
							echo "<td>....</td>"; 
							echo"</tr>"; 
						}
						// item suivant
						$row3 = mysql_fetch_assoc($res3);
						$j++;
					}
					echo "</table>";
				}
?>
<a href='index.php5?page=historique'>Retour à l'historique</a>