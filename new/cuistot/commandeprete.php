<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	$id = $_GET['id'];
	require('../outils/outilsBD.php');
	$url = "UPDATE commandes SET livre=1 WHERE id=".$id;
	echo($url);
	$res = queryDB($url, 'update', '../');
	echo "<script> location = '../cuistot.php'; </script>";
?>