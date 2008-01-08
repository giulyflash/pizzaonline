<?php
	if(empty($_POST['type']) || empty($_POST['description']) || empty($_POST['id']) || empty($_POST['prix']) || empty($_POST['quantite']))
	{
		echo '<h1>Erreur</h1>Erreur dans la sélection de l\'article.';
		echo '<br /><a href="index.php5?page=noscrepes">Retour à la liste des crêpes</a>';
		echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
	}
	else
	{
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['type']=$_POST['type'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['id']=$_POST['id'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['prix']=$_POST['prix'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['description']=$_POST['description'];
		if(empty($_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']))
		{
			$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']=$_POST['quantite'];
		}
		else
		{
			$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']+=$_POST['quantite'];
		}
		echo '<h1>Ajout effectué</h1>Votre sélection a été ajoutée à votre panier.';
		echo '<br /><a href="index.php5?page=noscrepes">Retour à la liste des crêpes</a>';
		echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
	}
?>