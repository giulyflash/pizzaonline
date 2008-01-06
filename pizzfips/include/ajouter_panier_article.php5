<?php
	if(empty($_POST['type']) || empty($_POST['description']) || empty($_POST['id']) || empty($_POST['prix']) || empty($_POST['quantite']))
	{
		echo '<div class="title">Erreur</div>Erreur dans la selection de l\'article.';
	}
	else
	{
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['type']=$_POST['type'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['id']=$_POST['id'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['prix']=$_POST['prix'];
		$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['description']=$_POST['description'];
		if(empty($_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']))
			$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']=$_POST['quantite'];
		else
			$_SESSION['panier']['article'][$_POST['type'].'-'.$_POST['id']]['quantite']+=$_POST['quantite'];
		echo '<div class="title">Ajout effectue</div>Votre selection a ete ajoutee au panier.';
	}
	print_r($_SESSION);
?>