<script language="javascript">
	choix = "rien";
</script>

<?php
 	require('outils/outilsBD.php');
 	echo ("<div class=\"title\">Recherche</div>");
	echo ("Ingredients<form name = 'formRecherche' action='index.php5?page=resultat' method='post'> <select name='choix'>");
	
	$res1 = queryDB("SELECT ingredient FROM stocks ", 'select');
	$row1 = mysql_fetch_assoc($res1);
	if ($row1 == 0) {
		echo "Aucune";
	}
	while($row1){
		echo "<option value='".$row1["ingredient"]."'>".$row1["ingredient"]."</option>";
		$row1 = mysql_fetch_assoc($res1);
		}
	echo ("</select><input type='submit' value='rechercher' /></form>");
	echo "<div class='title'>Résultats</div>"; 
?>
