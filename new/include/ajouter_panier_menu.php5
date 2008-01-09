<?php
if(empty($_POST['send']))
{
	echo '<h1>Erreur<h1>Erreur dans la sélection de l\'article.';
	echo '<br /><a href="index.php5?page=menu">Retour à la liste des menus</a>';
	echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
}
else
{
	$idmenu ="";
	$tmp=array();
	$tmp['nommenu']=$_POST['nommenu'];
	$tmp['prix']=$_POST['prix'];
	if(empty($tmp['quantite']))
	{
		$tmp['quantite']=$_POST['quantite'];
	}
	else $tmp['quantite'] += $_POST['quantite'];
	if(!empty($_POST['nbgalette']))
	{
		$tmp['nbgalette'] = intval($_POST['nbgalette']);
		for($i=0;$i<$_POST['nbgalette'];$i++)
		{
			$idmenu.=$_POST['galette'.($i+1)];
			$tmp['galette'.($i+1)]=$_POST['galette'.($i+1)];
		}
	}
	if(!empty($_POST['nbcrepe']))
	{
		$tmp['nbcrepe'] = intval($_POST['nbcrepe']);
		for($i=0;$i<$_POST['nbcrepe'];$i++)
		{
			$idmenu.=$_POST['crepe'.($i+1)];
			$tmp['crepe'.($i+1)]=$_POST['crepe'.($i+1)];
		}
	}
	if(!empty($_POST['nbdessert']))
	{
		$tmp['nbdessert'] = intval($_POST['nbdessert']);
		for($i=0;$i<$_POST['nbdessert'];$i++)
		{
			$idmenu.=$_POST['dessert'.($i+1)];
			$tmp['dessert'.($i+1)]=$_POST['dessert'.($i+1)];
		}
	}
	if(!empty($_POST['nbboisson']))
	{
		$tmp['nbboisson'] = intval($_POST['nbboisson']);
		for($i=0;$i<$_POST['nbboisson'];$i++)
		{
			$idmenu.=$_POST['boisson'.($i+1)];
			$tmp['boisson'.($i+1)]=$_POST['boisson'.($i+1)];
		}
	}
	$_SESSION['panier']['menu'][$idmenu]=$tmp;
	echo '<h1>Ajout effectué</h1>Votre sélection a été ajoutée à votre panier.';
	echo '<br /><a href="index.php5?page=menu">Retour à la liste des menus</a>';
	echo '<br /><a href="index.php5?page=panier">Voir votre panier</a>';
}
?>