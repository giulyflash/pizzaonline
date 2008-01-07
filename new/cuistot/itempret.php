<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	$commande = $_GET['commande'];
	$item = $_GET['item'];
	$pret = $_GET['pret'];
	require('../outils/outilsBD.php');
	$url = "UPDATE itemscommandes SET pret=".$pret." WHERE commande=".$commande." AND item='".$item."'";
	echo($url);
	$res = queryDB($url, 'update', '../');
	echo $res;
	echo "<script> location = '../cuistot.php'; </script>";
?>