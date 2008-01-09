<?php
	$commande = $_GET['commande'];
	$item = $_GET['item'];
	$pret = $_GET['pret'];
	$parent = $_GET['parent'];
	require('../outils/outilsBD.php');
	if ($parent == 'Menu') {
		$url = "UPDATE itemsmenus SET pret=".$pret." WHERE idmenu=".$commande." AND id='".$item."'";
	}
	else {
		$url = "UPDATE itemscommandes SET pret=".$pret." WHERE commande=".$commande." AND item='".$item."'";
	}
	$res = queryDB($url, 'update', '../');
	header('location:../indexAdmin.php5');
?>