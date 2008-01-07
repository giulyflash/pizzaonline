<?php
	if(empty($_GET['type']) || $_GET['type']=="tous")
	{
		unset($_SESSION['panier']);
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