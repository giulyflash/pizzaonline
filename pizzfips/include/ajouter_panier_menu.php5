<?php
if(empty($_POST['send']) )
	{
		echo '<div class="title">Erreur</div>Erreur dans la selection de l\'article.';
	}
	else
	{
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nommenu']=$_POST['nommenu'];
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['prix']=$_POST['prix'];
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbgalette'] = intval($_POST['nbgalette']);
		for($i=0;$i<$_POST['nbgalette'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['galette'.($i+1)]=$_POST['galette'.($i+1)];
		}
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbcrepe'] = intval($_POST['nbcrepe']);
		for($i=0;$i<$_POST['nbcrepe'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['crepe'.($i+1)]=$_POST['crepe'.($i+1)];
		}
		$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['nbboisson'] = intval($_POST['nbboisson']);
		for($i=0;$i<$_POST['nbboisson'];$i++){
			$_SESSION['panier']['menu'][ $_POST['idmenu'] ]['boisson'.($i+1)]=$_POST['boisson'.($i+1)];
		}
		echo '<div class="title">Ajout effectue</div>Votre selection a ete ajoutee au panier.';
	}
	print_r($_SESSION);
?>