<h1>Historique de vos commandes</h1>
<?php
	require('outils/outilsBD.php');
	require('fonctions.php5');
	
	if($connecte)
	{
		$res = queryDB("SELECT * FROM commandes WHERE client=".$_SESSION['user_id']." ORDER BY date, heure", 'select');
		$i=1;
		$row = mysql_fetch_assoc($res);
		if ($row == 0) {
			echo "Aucune :)";
		}
		while($row){
			$idCommande = $row["id"];
			// date et heure de la commande
			$date = $row["date"];
			$heure = $row["heure"];
			echo "<a href='index.php5?page=commandes&idcommande=".$idCommande."'>Commande passée le ".datefr($date)." à  $heure</a><br/>";
			$row = mysql_fetch_assoc($res);
			$i++;
		}
	}
	else
	{
		echo '<h1>Erreur</h1>
		Vous devez être connecté pour modifier votre profil';
	}
						
	
?>