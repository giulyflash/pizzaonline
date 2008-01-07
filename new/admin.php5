<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<?php
 	require('outils/outilsBD.php');
 	echo ("<div class=\"title\">Nouvelle galette</div>");
	echo ("<form action=\"index.php5?page=ajouter_perso\" method=\"post\">");
	echo ("<input type=\"hidden\" name = \"type\" value = \"galette\"> <table><tr><th>Composition</th><th>Prix</th><th>Ajouter</th></tr>");
	
	$res1 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 1 or sucresale = 2) ", 'select');
	$row1 = mysql_fetch_assoc($res1);
	if ($row1 == 0) {
		echo "Aucune :)";
	}
	while($row1){
		echo "<tr>";
		echo "<td>".$row1["ingredient"]."<td\>";
		echo "<td>".$row1["prix"]."<td\>";
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row1["ingredient"]."\" /></td>";
		echo "</tr>";
		
		$row1 = mysql_fetch_assoc($res1);
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_galette_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_galette_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantité : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_galette_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
	
	echo ("<div class=\"title\">Nouvelle crêpe</div>");
	echo ("<form action=\"index.php5?page=ajouter_perso\" method=\"post\">");
	echo ("<input type=\"hidden\" name = \"type\" value = \"crepe\"><table><tr><th>Composition</th><th>Prix</th><th>Ajouter</th></tr>");
	

	$res2 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 0 or sucresale = 2) ", 'select');
	$row2 = mysql_fetch_assoc($res2);
	if ($row2 == 0) {
		echo "Aucune :)";
	}
	while($row2){
		echo "<tr>";
		echo "<td>".$row2["ingredient"]."<td\>";
		echo "<td>".$row2["prix"]."<td\>";
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\"/></td>";
		echo "</tr>";
		$row2 = mysql_fetch_assoc($res2);
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_crepe_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_crepe_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantite : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_crepe_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
?>
</body>
</html>
