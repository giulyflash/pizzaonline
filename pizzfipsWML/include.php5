<?php
	session_start();
	
	// gestion des id pour les crepes personnalisées
	if(!isset($_SESSION['id_perso']))
	{
		$_SESSION['id_perso']=0;
	}
	
	// gestion des pseudo frame
	if(empty($_GET['page']))
	{
		$page="include/accueil.php5";
		$title="Accueil";
	}
	else
	{
		// Connexion <> Deconnexion
		if($_GET['page']=="connexion")
		{
			db_connect();
			$query='SELECT id,login FROM client WHERE login="'.mysql_real_escape_string($_POST['login_name']).'" AND password="'.mysql_real_escape_string($_POST['login_pass']).'"';
			$res=db_object_single($query);
			db_close();
			if($res)
			{
				$_SESSION['user_id']=$res->id;
				$_SESSION['login']=$res->login;
			}
			$auth_error=($res==false);
		}
		else if($_GET['page']=="deconnexion")
		{
			session_unset();
			session_destroy();
		}else if($_GET['page']=="historique")
		{
			$page="include/historique.php5";
			$title="Historique";
		}
		
		switch($_GET['page'])
		{
			
			case "accueil":
			$page="include/accueil.php5";
			$title="Accueil";
			break;
			
			case "menu":
			$page="include/menu2.php5";
			$title="Nos menus";
			break;
			
			case "noscrepes":
			$page="include/nosGalettesCrepes.php5";
			$title="Nos galettes et nos crêpes";
			break;
			
			case "voscrepes":
			$page="include/vosGalettesCrepes.php5";
			$title="Vos galettes et crêpes personalisées";
			break;
			
			case "commandes":
			$page="include/commandes.php5";
			$title="Recherchez l'historique de vos commandes";
			break;
			
			case "recherche":
			$page="include/recherche.php5";
			$title="Recherchez vos crêpes et galettes préférées";
			break;
			
			case "panier":
			$page="include/panier.php5";
			$title="Votre panier";
			break;
			
			case "inscription":
			$page="include/inscription.php5";
			$title="S'inscrire";
			break;
			
			case "fin_inscription":
			$page="include/fin_inscription.php5";
			$title="Fin de l'inscription";
			break;
			
			case "connexion":
			$page="include/connexion.php5";
			$title="Connexion";
			break;
			
			case "deconnexion":
			$page="include/deconnexion.php5";
			$title="Déconnexion";
			break;
			
			case "profil":
			$page="include/profil.php5";
			$title="Modifier votre profil";
			break;
			
			case "fin_profil":
			$page="include/fin_profil.php5";
			$title="Fin de la modification de votre profil";
			break;
			
			case "ajouter_article":
			$page="include/ajouter_panier_article.php5";
			$title="Ajout d'un article à votre panier";
			break;
			
			case "ajouter_menu":
			$page="include/ajouter_panier_menu.php5";
			$title="Ajout d'un article à votre panier";
			break;
			
			case "ajouter_perso":
			$page="include/ajouter_panier_perso.php5";
			$title="Ajout d'une crêpe personnalisée à votre panier";
			break;
			
			case "modifier_article":
			$page="include/modif_panier_article.php5";
			$title="Modification d'un article sur votre panier";
			break;
			
			case "modifier_menu":
			$page="include/modif_panier_menu.php5";
			$title="Modification d'un article sur votre panier";
			break;
			
			case "modifier_perso":
			$page="include/modif_panier_perso.php5";
			$title="Modification d'une crêpe personnalisée sur votre panier";
			break;
			
			case "valider_commande":
			$page="include/valider_panier.php5";
			$title="Validation de votre commande";
			break;
			
			case "vider_panier":
			$page="include/vider_panier.php5";
			$title="Réinitialisation de votre panier";
			break;
		}
	}
	
	// gestion de la connexion
	if(isset($_SESSION['user_id']))
	{
		$connecte=true;
		$user_id=$_SESSION['user_id'];
		$login_name=$_SESSION['login'];
	}
	else
	{
		$connecte=false;
		$user_id=0;
	}
?>
