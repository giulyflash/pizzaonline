<?php
	if(empty($_POST['type']) || empty($_POST['description']) || empty($_POST['id']) || empty($_POST['prix']) || empty($_POST['quantite']))
	{
		echo '<div class="title">Erreur</div>Erreur dans la s�lection de l\'article.';
		echo '<br /><a href="index.php5?page=noscrepes">Retour � la liste des cr�pes</a>';
		echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
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
		echo '<div class="title">Ajout effectu�</div>Votre s�lection a �t� ajout�e au panier.';
		echo '<br /><a href="index.php5?page=noscrepes">Retour � la liste des cr�pes</a>';
		echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
	}
?>