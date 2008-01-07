<?php
	if(!$connecte)
	{
		echo '<div class="title">Erreur</div>
			Vous devez être connecté pour valider votre commande.
		';
	}
	else
	{
		db_connect();
		
		
		// Création de la commande
		db_query('INSERT INTO commandes(client,date,heure,livre) VALUES(\''.$_SESSION['user_id'].'\', CURRENT_DATE(), CURRENT_TIME(), 0)');
		$id_commande=db_last_id();
		
		// Ajout des articles
		foreach($_SESSION['panier']['article'] as $key=>$value)
		{
			db_query('INSERT INTO itemscommandes(commande,item,quantite,pret) VALUES(\''.$id_commande.'\', \''.$value['id'].'\', \''.$value['quantite'].'\', 0)');
		}
		
		// Ajout des personnalisées
		foreach($_SESSION['panier']['perso'] as $key=>$value)
		{
			$sucree=($value['type']=="crepe");
			$id="titi";
			db_query('INSERT INTO perso(idperso,sucre) VALUES(\''.$id.'\', '.(($sucree)?"1":"0").')');
			foreach($_SESSION['panier']['perso'][$key]['ingredient'] as $ingredient)
			{
				db_query('INSERT INTO ingredientsperso(idperso,ingredient) VALUES(\''.$id.'\', \''.$ingredient.'\')');
			}
			db_query('INSERT INTO itemscommandes(commande,item,quantite,pret) VALUES(\''.$id_commande.'\', \''.$id.'\', \''.$value['quantite'].'\', 0)');
		}
		
		echo 'INSERT INTO commandes(client,date,heure,livre) VALUES(\''.$_SESSION['user_id'].'\', CURRENT_DATE(), CURRENT_TIME(), 0)';
		db_close();
		echo '<div class="title">Commande effectuée</div>
			Votre a été effectuée.
		';
	}
?>