<?php
	if(!$connecte)
	{
		echo '<h1>Erreur</h1>Vous devez être connecté pour valider votre commande.';
	}
	else if(empty($_SESSION['panier']))
	{
		echo '<h1>Erreur</h1>Au moins un article est nécessaire dans votre panier pour pouvoir valider votre commande.';
	}
	else
	{	
		// Gestion des stocks
		$dom_object = new DomDocument();
		$dom_object->load("xml/nourriture.xml");
		$xpath = new Domxpath($dom_object);
		// Recuperation des ingredients des articles
		if(!empty($_SESSION['panier']['article']))
		{
			foreach($_SESSION['panier']['article'] as $key=>$value)
			{
				switch($value['type'])
				{
					case "Galette":
					$result = $xpath->query("//Galette[Nom='".$value['id']."']/Ingredients/Ingredient");
					if ($result->length != 0)
					{
						foreach ($result as $ing)
						{
							if(empty($ingre[$ing->nodeValue]))
							{
								$ingre[$ing->nodeValue]=$value['quantite'];
							}
							else
							{
								$ingre[$ing->nodeValue]+=$value['quantite'];
							}
						}
					}
					break;
					
					case "Crepe":
					$result = $xpath->query("//Crepe[Nom='".$value['id']."']/Ingredients/Ingredient");
					if ($result->length != 0)
					{
						foreach ($result as $ing)
						{
							if(empty($ingre[$ing->nodeValue]))
							{
								$ingre[$ing->nodeValue]=$value['quantite'];
							}
							else
							{
								$ingre[$ing->nodeValue]+=$value['quantite'];
							}
						}
					}
					break;
					
					case "Boisson":
					echo "boisson";
					$result = $xpath->query("//Boisson[Nom='".$value['id']."']");
					if ($result->length != 0)
					{
						if(empty($ingre[$value['id']]))
							{
								$ingre[$value['id']]=$value['quantite'];
							}
							else
							{
								$ingre[$value['id']]+=$value['quantite'];
							}
					}
					break;
					
					case "Dessert":
					echo "dessert";
					$result = $xpath->query("//Dessert[Nom='".$value['id']."']");
					if ($result->length != 0)
					{
						if(empty($ingre[$value['id']]))
							{
								$ingre[$value['id']]=$value['quantite'];
							}
							else
							{
								$ingre[$value['id']]+=$value['quantite'];
							}
					}
					break;
				}
			}
		}
		
		// Recuperation des ingredients des articles perso
		if(!empty($_SESSION['panier']['perso']))
		{
			foreach($_SESSION['panier']['perso'] as $key=>$value)
			{
				foreach($_SESSION['panier']['perso'][$key]['ingredient'] as $ingredient)
				{
					if(empty($ingre[$ingredient]))
					{
						$ingre[$ingredient]=$value['quantite'];
					}
					else
					{
						$ingre[$ingredient]+=$value['quantite'];
					}
				}
			}
		}
		
		// Recuperation des ingredients des articles des menus
		if(!empty($_SESSION['panier']['menu']))
		{
			foreach($_SESSION['panier']['menu'] as $key=>$value)
			{
				if(empty($value['nbgalette'])) $nbgalette = 0;
				else $nbgalette = intval($value['nbgalette']);
				for($i=0;$i<$nbgalette;$i++)
				{
					$result = $xpath->query("//Galette[Nom='".$value['galette'.($i+1)]."']/Ingredients/Ingredient");
					if ($result->length != 0)
					{
						foreach ($result as $ing)
						{
							if(empty($ingre[$ing->nodeValue]))
							{
								$ingre[$ing->nodeValue]=$value['quantite'];
							}
							else
							{
								$ingre[$ing->nodeValue]+=$value['quantite'];
							}
						}
					}
				}
				if(empty($value['nbcrepe'])) $nbcrepe = 0;
				else $nbcrepe = intval($value['nbcrepe']);
				for($i=0;$i<$nbcrepe;$i++)
				{
					$result = $xpath->query("//Crepe[Nom='".$value['crepe'.($i+1)]."']/Ingredients/Ingredient");
					if ($result->length != 0)
					{
						foreach ($result as $ing)
						{
							if(empty($ingre[$ing->nodeValue]))
							{
								$ingre[$ing->nodeValue]=$value['quantite'];
							}
							else
							{
								$ingre[$ing->nodeValue]+=$value['quantite'];
							}
						}
					}
				}
				if(empty($value['nbboisson'])) $nbboisson = 0;
				else $nbboisson = intval($value['nbboisson']);
				for($i=0;$i<$nbboisson;$i++)
				{
					if(empty($ingre[$value['boisson'.($i+1)]]))
					{
						$ingre[$value['boisson'.($i+1)]]=$value['quantite'];
					}
					else
					{
						$ingre[$value['boisson'.($i+1)]]+=$value['quantite'];
					}
				}
				if(empty($value['nbdessert'])) $nbdessert = 0;
				else $nbdessert = intval($value['nbdessert']);
				for($i=0;$i<$nbdessert;$i++)
				{
					if(empty($ingre[$value['dessert'.($i+1)]]))
					{
						$ingre[$value['dessert'.($i+1)]]=$value['quantite'];
					}
					else
					{
						$ingre[$value['dessert'.($i+1)]]+=$value['quantite'];
					}
				}
			}
		}
		
		db_connect();
		if(empty($ingre))
		{
			echo '<h1>Erreur</h1>Au moins un article est nécessaire dans votre panier pour pouvoir valider votre commande.';
		}
		else {
			// Verification que tous les ingredients sont en stock suffisant
			foreach($ingre as $key=>$value)
			{
				if(db_object_single('SELECT quantite FROM stocks WHERE ingredient=\''.$key.'\'')->quantite<$value)
					$ingre_insuffisant[]=$key;
			}
		
			if(!empty($ingre_insuffisant))
			{
				echo '<h1>Erreur</h1>Des ingrédients sont en quantité insuffisante pour honorer votre commande veuillez de retirer des articles étant composés de :<ul>';
				foreach($ingre_insuffisant as $key=>$value)
				{
					echo '<li>'.$value.'</li>';
				}
				echo '</ul>';
			}
			else
			{
				// Retrait des ingrédients des produits commandés du stock
				foreach($ingre as $key=>$value)
				{
					db_query("UPDATE stocks SET quantite=(quantite-".$value.") WHERE ingredient='".$key."'");
				}
				
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
							db_query('INSERT INTO ingredientsperso(idperso,ingredient) VALUES(\''.$id_perso.'\', \''.$ingredient.'\')');
						}
						db_query('INSERT INTO itemscommandes(commande,item,quantite,pret,type) VALUES(\''.$id_commande.'\', \''.$id_perso.'\', \''.$value['quantite'].'\', 0, \'Perso\')');
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
						if(empty($value['nbdessert'])) $nbdessert = 0;
						else $nbdessert = intval($value['nbdessert']);
						for($i=0;$i<$nbdessert;$i++)
						{
							db_query('INSERT INTO itemsmenus(idmenu,type,item,pret) VALUES(\''.$id_menu.'\', \'Dessert\', \''.$value['dessert'.($i+1)].'\', 0)');
						}
						db_query('INSERT INTO itemscommandes(commande,item,quantite,pret,type) VALUES(\''.$id_commande.'\', \''.$id_menu.'\', \''.$value['quantite'].'\', 0, \'Menu\')');
					}
				}
				
				unset($_SESSION['panier']);
				
				db_close();
				echo '<div class="title">Commande effectuée</div>
					Votre commande a été effectuée.
				';
			}
		}
	}
?>