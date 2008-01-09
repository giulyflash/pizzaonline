<?php
	$id = $_GET['id'];
	require('../outils/outilsBD.php');
	$url = "UPDATE commandes SET livre=1 WHERE id=".$id;
	$res = queryDB($url, 'update', '../');
	header('location:../indexAdmin.php5');
?>