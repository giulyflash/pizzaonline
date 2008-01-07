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
		
		print_r($_SESSION['panier']);
		
		// Création de la commande
		db_query('INSERT INTO commandes(client,date,heure,livre) VALUES(\''.$_SESSION['user_id'].'\', CURRENT_DATE(), CURRENT_TIME(), 0)');
		$id_commande=db_last_id();
		
		// Ajout des articles
		if(!empty($_SESSION['panier']['article']))
		{
			foreach($_SESSION['panier']['article'] as $key=>$value)
			{
				db_query('INSERT INTO itemscommandes(commande,item,quantite,pret,type) VALUES(\''.$id_commande.'\', \''.$value['id'].'\', \''.$value['quantite'].'\', 0, \''.$value['type'].'\')');
			}
		}
				
		// Ajout des personnalisées
		if(!empty($_SESSION['panier']['perso']))
		{
			foreach($_SESSION['panier']['perso'] as $key=>$value)
			{
				$sucree=($value['type']=="crepe");
				db_query('INSERT INTO perso(sucre) VALUES('.(($sucree)?"1":"0").')');
				$id_perso=db_last_id();
				foreach($_SESSION['panier']['perso'][$key]['ingredient'] as $ingredient)
				{
					db_query('INSERT INTO ingredientsperso(idperso,ingredient) VALUES(\''.$id.'\', \''.$ingredient.'\')');
				}
				db_query('INSERT INTO itemscommandes(commande,item,quantite,pret,type) VALUES(\''.$id_commande.'\', \''.$id.'\', \''.$value['quantite'].'\', 0, \'Perso\')');
			}
		}
		
		// Ajout des menus
		if(!empty($_SESSION['panier']['menu']))
		{
			foreach($_SESSION['panier']['menu'] as $key=>$value)
			{
				db_query('INSERT INTO menus(type) VALUES(\''.$value['nommenu'].'\')');
				
				$id_menu=db_last_id();
				if(empty($value['nbgalette'])) $nbgalette = 0;
				else $nbgalette = intval($value['nbgalette']);
				for($i=0;$i<$nbgalette;$i++)
				{
				echo 'INSERT INTO itemsmenus(idmenu,type,item,pret) VALUES(\''.$id_menu.'\', \'Galette\', \''.$value['galette'.($i+1)].'\', 0)';
					db_query('INSERT INTO itemsmenus(idmenu,type,item,pret) VALUES(\''.$id_menu.'\', \'Galette\', \''.$value['galette'.($i+1)].'\', 0)');
				}
				if(empty($value['nbcrepe'])) $nbcrepe = 0;
				else $nbcrepe = intval($value['nbcrepe']);
				for($i=0;$i<$nbcrepe;$i++)
				{
					db_query('INSERT INTO itemsmenus(idmenu,type,item,pret) VALUES(\''.$id_menu.'\', \'Crepe\', \''.$value['crepe'.($i+1)].'\', 0)');
				}
				if(empty($value['nbboisson'])) $nbboisson = 0;
				else $nbboisson = intval($value['nbboisson']);
				for($i=0;$i<$nbboisson;$i++)
				{
					db_query('INSERT INTO itemsmenus(idmenu,type,item,pret) VALUES(\''.$id_menu.'\', \'Boisson\', \''.$value['boisson'.($i+1)].'\', 0)');
				}
				db_query('INSERT INTO itemscommandes(commande,item,quantite,pret,type) VALUES(\''.$id_commande.'\', \''.$id_menu.'\', \''.$value['quantite'].'\', 0, \'Menu\')');
			}
		}
		
		unset($_SESSION['panier']);
		
		db_close();
		echo '<div class="title">Commande effectuée</div>
			Votre a été effectuée.
		';
	}
?>