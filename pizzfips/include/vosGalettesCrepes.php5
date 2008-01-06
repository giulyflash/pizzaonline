<script type="text/javascript">
	var prix_ingredient=new Array();
	var prix=0;
	
	function maj_prix(obj,cout)
	{
		if(obj.checked)
		{
			prix+=cout;
		}
		else
		{
			prix-=cout;
		}
		document.getElementById('custom_crepe_prix_affiche').value=prix;
		document.getElementById('custom_crepe_prix').value=prix;
	}
</script>
 <?php
 	require('outils/outilsBD.php');
 	echo ("<div class=\"title\">Votre galette</div>");
	echo ("<form action=\"index.php5?page=ajouter_perso\" method=\"post\">");
	echo ("<table><tr><th>Composition</th><th>Prix</th><th>Ajouter</th></tr>");
	
	$res2 = queryDB("SELECT ingredient, prix, type FROM stocks WHERE type = \"galette \" or type = \"both\" ", 'select');

	$row1 = mysql_fetch_assoc($res1);
	if ($row1 == 0) {
		echo "Aucune :)";
	}
	while($row1){
		echo "<tr>";
		echo "<td>".$row1["ingredient"]."<td\>";
		echo "<td>".$row1["prix"]."<td\>";
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row1["ingredient"]."\""; 
		echo "onclick=\"maj_prix(this,".$row1["prix"].");\" /></td>";
		echo "</tr>";
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_galette_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_crepe_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantite : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_galette_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
	echo ("<div class=\"title\">Votre crêpe</div>");
	echo ("<form action=\"index.php5?page=ajouter_perso\" method=\"post\">");
	echo ("<table><tr><th>Composition</th><th>Prix</th><th>Ajouter</th></tr>");
	

	$res2 = queryDB("SELECT ingredient, prix, type FROM stocks WHERE type = \"crepe \" or type = \"both\" ", 'select');

	$row2 = mysql_fetch_assoc($res2);
	if ($row2 == 0) {
		echo "Aucune :)";
	}
	while($row2){
		echo "<tr>";
		echo "<td>".$row2["ingredient"]."<td\>";
		echo "<td>".$row2["prix"]."<td\>";
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\""; 
		echo "onclick=\"maj_prix(this,".$row2["prix"].");\" /></td>";
		echo "</tr>";
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_crepe_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_crepe_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantite : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_crepe_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
?>