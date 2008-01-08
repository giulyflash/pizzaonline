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
	echo $url;
	$res = queryDB($url, 'update', '../');
	echo $res;
	//header('location:../indexAdmin.php5');
?>