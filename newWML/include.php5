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
			$title="Nos galettes et nos crepes";
			break;
			
			case "voscrepes":
			$page="include/vosGalettesCrepes.php5";
			$title="Vos galettes et crepes personalisees";
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
