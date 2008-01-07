
<?php
//-----------------------------------------CONNEXION-----------------------------------------------------------------------
// Se connecte à la DB
// Paramètres : nom de la base -> $name_DB
function connexion_DB($name_DB) {
	// Connexion au serveur
	include '../config/parametres.php';

	mysql_connect($host, $user, $passwd) or die("erreur de connexion au serveur");
	mysql_select_db($bdd) or die("erreur de connexion a la base de donnees");
}
//-----------------------------------------DECONNEXION---------------------------------------------------------------------------------
// Deconnection de la DB
function deconnexion_DB() {
	mysql_close();
}
//---------------------------------------------REQUETE-SQL----------------------------------------------------------------------------
// Exécute une requète SQL. Si la requête ne passe pas, renvoir le message d'erreur MySQL
// Paramètres : chaine SQL -> $strSQL
// Renvoie : enregistrements correspondants -> $result
function requete_SQL($strSQL) {
$result = mysql_query($strSQL);
	if (!$result) {
		$message = 'Erreur SQL : ' . mysql_error() . "<br>\n";
		$message .= 'SQL string : ' . $strSQL . "<br>\n";
		$message .= "Merci d'envoyer ce message au webmaster";
		die($message);
	}
	return $result;
}

//-----------------------------------------DATABASE---------------------------------------------------------------------------------
// Récupère les informations de la page concernée
function extraction_infos_DB() {
	$strSQL = 'SELECT * FROM `pages` WHERE `Id_page` = '.$_ENV['id_page'];
	$resultat = requete_SQL($strSQL);
	$tabl_result = mysql_fetch_array($resultat);
	$_ENV['mots_cles'] = $tabl_result['Mots_cles'];
	$_ENV['description'] = $tabl_result['Description'];
	$_ENV['titre'] = $tabl_result['Titre'];
	$_ENV['contenu'] = $tabl_result['Contenu'];
	$_ENV['id_parent'] = $tabl_result['Id_parent'];
}
//--------------------------------------------MENU------------------------------------------------------------------------------
// Affiche le chemin de fer.
// Paramètres : id de la page en cours -> $idpage
// Renvoie : chemin complet -> $chemin_complet
//-----------------------------------------
function affiche_chemin_fer($idpage) {
	// on définit la variable pour éviter le warning
	$chemin_complet = "<br><font size='2' >";
	// Si l'id de la page en cours est différent de 0
	// (0 = page parente de la page racine = inexistante)
	if ($idpage != 0) {
		// on récupère les informations de la page en cours dans la DB
		$strSQL = 'SELECT `Id_page`, `Titre`, `Id_parent`, `Description` FROM `pages` WHERE `Id_parent` = '.$idpage. ' ORDER BY Id_page';
		$resultat = requete_SQL($strSQL);
		while ($tabl_result = mysql_fetch_array($resultat)) {
		$titrepage = $tabl_result['Titre'];
		$description = $tabl_result['Description'];
		$idparent = $tabl_result['Id_parent'];
		// création du lien vers la page en cours
		$chemin_page_en_cours = ' - <a target=cadreprincipal href="http://127.0.0.1/SiteSPCSF/'.$tabl_result['Titre'].'.php?id_page='.$idpage.'">'.$description.'</a>';
		// Concaténation du lien de la page N-1 et
		// du lien de la page en cours
		$chemin_complet .= $chemin_page_en_cours;
		}
		$chemin_complet .= '</font>';
	}
	// renvoie le chemin complet
	return $chemin_complet;
}
//------------------------------------------------
// Affiche les menus verticalement.
// Paramètres : id de la page -> $idpage
// (id de la page en cours pour le menu vertical, id de la page racine (1) pour le menu horizontal)
// Renvoie : le menu sous forme de liste -> $menu_retour
//------------------------------------------------
function affiche_menu($idpage) {
	// Sélectionne toutes les pages filles de la page en cours
	$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` = '.$idpage.' ORDER BY Id_page';
	$resultat = requete_SQL($strSQL);

	$menu_retour = '<ul>';
	while ($tabl_result = mysql_fetch_array($resultat)) {
		$menu_retour .= '<li>';
		$menu_retour .= '<a target="cadreprincipal" href="http://127.0.0.1/SiteSPCSF/'.$tabl_result['Titre'].'.php?id_page='.$tabl_result['Id_page'].'">';
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '</a>';
		$menu_retour .= affiche_chemin_fer($tabl_result['Id_page']);
		$menu_retour .= '</li>';
	}
	$menu_retour .= '</ul>';
	return $menu_retour;
}
//-------------------------------------------------
// Affiche les menus horizontalement.
// Paramètres : id de la page -> $idpage
// (id de la page en cours pour le menu vertical, id de la page racine (1) pour le menu horizontal)
// Renvoie : le menu sous forme de liste -> $menu_retour
//--------------------------------------------------
function affiche_menu_horizontal($idpage) {
	// Sélectionne toutes les pages filles de la page en cours
	$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` = '.$idpage. ' ORDER BY `Id_page`';
	$resultat = requete_SQL($strSQL);
	// Si la page n'a pas de page fille, alors on modifie la requète pour obtenir ses pages soeurs.
	if (mysql_num_rows($resultat) == 0) {
		$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` =
		'.$_ENV['id_parent'];
		$resultat = requete_SQL($strSQL);
	}
	$menu_retour="";
	while ($tabl_result = mysql_fetch_array($resultat)) {
		if($tabl_result['Id_page']== $idpage){
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '&nbsp;&nbsp;&nbsp;';
		}else {
		$menu_retour .= '<a target="cadreprincipal" href="http://127.0.0.1/SiteSPCSF/'.$tabl_result['Titre'].'.php?id_page='.$tabl_result['Id_page'].'">';
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '</a>&nbsp;&nbsp;&nbsp;';
		}
	}
	return $menu_retour;
}
function affiche_menu_onglet($idpage,$idpere) {
	//Sélectionne l'id du pere
	$pereSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_page` = '.$idpere;
	$pereresultat = requete_SQL($pereSQL);
	$pere=mysql_fetch_array($pereresultat);
	// Sélectionne toutes les pages filles de la page en cours
	$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` = '.$idpage. ' ORDER BY `Id_page`';
	$resultat = requete_SQL($strSQL);
	// Si la page n'a pas de page fille, alors on modifie la requète pour obtenir ses pages soeurs.
	if (mysql_num_rows($resultat) == 0) {
		$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` ='.$_ENV['id_parent']. ' ORDER BY `Id_page`';
		$resultat = requete_SQL($strSQL);
	}
	$menu_retour='<div id="onglet"><ul>';
	if($idpage == $pere['Id_page'])$menu_retour .= '<li id="current">';
	else $menu_retour .= '<li>';
	$menu_retour .= '<a target="cadreprincipal" href="http://127.0.0.1/SiteSPCSF/'.$pere['Titre'].'.php?id_page='.$pere['Id_page'].'">'.$pere['Description'].'</a></li>';
	while ($tabl_result = mysql_fetch_array($resultat)) {
		if($tabl_result['Id_page']== $idpage){
		$menu_retour .= '<li id="current"><a target="cadreprincipal" href="'.$_SERVER['PHP_SELF'].'?id_page='.$idpage.'">'.$tabl_result['Description'];
		$menu_retour .= '</a></li>';
		}else {
		$menu_retour .= '<li><a target="cadreprincipal" href="http://127.0.0.1/SiteSPCSF/'.$tabl_result['Titre'].'.php?id_page='.$tabl_result['Id_page'].'">';
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '</a></li>';
		}
	}
	$menu_retour .= '</ul></div>';
	return $menu_retour;
}

function affiche_plan($idpage) {
	// Sélectionne toutes les pages filles de la page en cours
	$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` = '.$idpage. ' ORDER BY `Id_page`';
	$resultat = requete_SQL($strSQL);
	// Si la page n'a pas de page fille, alors on modifie la requète pour obtenir ses pages soeurs.
	if (mysql_num_rows($resultat) == 0) {
		$strSQL = 'SELECT `Id_page`, `Titre`, `Description` FROM `pages` WHERE `Id_parent` ='.$_ENV['id_parent'];
		$resultat = requete_SQL($strSQL);
	}
	$menu_retour="<div>";
	while ($tabl_result = mysql_fetch_array($resultat)) {
		if($tabl_result['Id_page']== $idpage){
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '&nbsp;&nbsp;&nbsp;';
		}else {
		$menu_retour .= '<a target="cadreprincipal" href="http://127.0.0.1/SiteSPCSF/'.$tabl_result['Titre'].'.php?id_page='.$tabl_result['Id_page'].'">';
		$menu_retour .= $tabl_result['Description'];
		$menu_retour .= '</a>';
		$menu_retour .= "<div><font size='3' >&nbsp;&nbsp;"; 
		$menu_retour .= affiche_menu($tabl_result['Id_page']); 
		$menu_retour .= "</font></div>";
		
		}
	}
	$menu_retour.="</div>";
	return $menu_retour;
}

//----------------------------------------------GENERAL---------------------------------------------
function select($requete,$value){
	$resultat = requete_SQL($requete);
 	$enreg = mysql_fetch_row($resultat);
 	while ($enreg != NULL ) {
		if($enreg[0]!==0 && $enreg[0]!=""){
    		if($value===0) $value=$enreg[0];
    		if ($enreg[0]==$value) echo "<option selected value='" . $enreg[0] . "'>" . $enreg[1]; 
    		else {
    		echo "<option value='" . $enreg[0] . "'>" . $enreg[1]; 
    		}
		}
		$enreg = mysql_fetch_row($resultat);
 	}
	return $value;
}

function selectTous($requete,$value){
	$resultat = requete_SQL($requete);
 	$enreg = mysql_fetch_row($resultat);
	if ($value==0) { echo "<option selected value='" . 0 . "'>Toutes";}
 	else{echo "<option value='0'> Toutes"; }
 	while ($enreg != NULL ) {
		if($enreg[0]!==0 && $enreg[0]!=""){
    		if ($enreg[0]==$value) echo "<option selected value='" . $enreg[0] . "'>" . $enreg[1]; 
    		else {
    		echo "<option value='" . $enreg[0] . "'>" . $enreg[1]; 
    		}
		}
		$enreg = mysql_fetch_row($resultat);
 	}
	return $value;
}

?>
