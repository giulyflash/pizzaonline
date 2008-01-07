<?php
	if(empty($_GET['type']) || $_GET['type']=="tous")
	{
		session_unset();
		session_destroy();
	}
	else
	{
		switch($_GET['type'])
		{
			case "article":
			unset($_SESSION['panier']['article']);
			break;
			
			case "menu":
			unset($_SESSION['panier']['menu']);
			break;
			
			case "perso":
			unset($_SESSION['panier']['perso']);
			break;
		}
	}
?>