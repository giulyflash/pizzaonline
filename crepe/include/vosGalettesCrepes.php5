<script type="text/javascript">
	var prix_ingredient_crepe=new Array();
	var prix_crepe=0;
	var prix_ingredient_galette=new Array();
	var prix_galette=0;
	function maj_prix_galette(obj,cout)
	{
		if(obj.checked)
		{
			prix_galette+=cout;
		}
		else
		{
			prix_galette-=cout;
		}
		document.getElementById('custom_galette_prix_affiche').value=prix_galette;
		document.getElementById('custom_galette_prix').value=prix_galette;
	}
	function maj_prix_crepe(obj,cout)
	{
		if(obj.checked)
		{
			prix_crepe+=cout;
		}
		else
		{
			prix_crepe-=cout;
		}
		document.getElementById('custom_crepe_prix_affiche').value=prix_crepe;
		document.getElementById('custom_crepe_prix').value=prix_crepe;
	}
</script>
 <?php
 	require('outils/outilsBD.php');
 	echo ("<div class=\"title\">Votre galette</div>");
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
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row1["ingredient"]."\""; 
		echo "onclick=\"maj_prix_galette(this,".$row1["prix"].");\" /></td>";
		echo "</tr>";
		
		$row1 = mysql_fetch_assoc($res1);
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_galette_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_galette_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantité : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_galette_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
	
	echo ("<div class=\"title\">Votre crêpe</div>");
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
		echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\""; 
		echo "onclick=\"maj_prix_crepe(this,".$row2["prix"].");\" /></td>";
		echo "</tr>";
		$row2 = mysql_fetch_assoc($res2);
		}
	echo ("<tr><td colspan=\"3\">Prix : <input type=\"text\"id=\"custom_crepe_prix_affiche\" value=\"0\" disabled=\"disabled\" />");
	echo ("<input type=\"hidden\" id=\"custom_crepe_prix\" name=\"prix\" value=\"0\" /></td></tr>");
	echo ("<tr><td colspan=\"3\">Quantite : <input type=\"text\" value=\"1\" name=\"quantite\" id=\"custom_crepe_quantite\" />");
	echo ("<input type=\"image\" src=\"interf/panier.gif\" /></td></tr></table></form>");
?>