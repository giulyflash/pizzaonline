<?php
	session_start();

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
		}
		
		switch($_GET['page'])
		{
			case "accueil":
			$page="include/accueil.php5";
			$title="Accueil";
			break;
			
			case "menu":
			$page="include/menu.php5";
			$title="Nos menus";
			break;
			
			case "crepe":
			$page="include/crepe.php5";
			$title="Nos pizzas";
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
			
			case "connexion";
			$page="include/connexion.php5";
			$title="Connexion";
			break;
			
			case "deconnexion";
			$page="include/deconnexion.php5";
			$title="Deconnexion";
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
