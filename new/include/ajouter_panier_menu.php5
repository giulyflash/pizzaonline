<?php
if(empty($_POST['send']))
{
	echo '<div class="title">Erreur</div>Erreur dans la sélection de l\'article.';
	echo '<br /><a href="index.php5?page=menu">Retour à la liste des menus</a>';
	echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
}
else
{
	$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nommenu']=$_POST['nommenu'];
	$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['prix']=$_POST['prix'];
	if(empty($_SESSION['panier']['menu'][ $_POST['idmenu'] ]['quantite'])){
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['quantite']=$_POST['quantite'];
	}else $_SESSION['panier']['menu'][ $_POST['idmenu'] ]['quantite'] += $_POST['quantite'];
	if(!empty($_POST['nbgalette'])){
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbgalette'] = intval($_POST['nbgalette']);
		for($i=0;$i<$_POST['nbgalette'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['galette'.($i+1)]=$_POST['galette'.($i+1)];
		}
	}
	if(!empty($_POST['nbcrepe'])){
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbcrepe'] = intval($_POST['nbcrepe']);
		for($i=0;$i<$_POST['nbcrepe'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['crepe'.($i+1)]=$_POST['crepe'.($i+1)];
		}
	}
	if(!empty($_POST['nbdessert'])){
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbdessert'] = intval($_POST['nbdessert']);
		for($i=0;$i<$_POST['nbdessert'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['dessert'.($i+1)]=$_POST['dessert'.($i+1)];
		}
	}
	if(!empty($_POST['nbboisson'])){
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbboisson'] = intval($_POST['nbboisson']);
		for($i=0;$i<$_POST['nbboisson'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['boisson'.($i+1)]=$_POST['boisson'.($i+1)];
		}
	}
	echo '<div class="title">Ajout effectué</div>Votre sélection a été ajoutée au panier.';
	echo '<br /><a href="index.php5?page=menu">Retour à la liste des menus</a>';
	echo '<br /><a href="index.php5?page=panier">Voir le panier</a>';
}
?>