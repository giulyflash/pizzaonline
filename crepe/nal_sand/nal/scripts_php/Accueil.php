<?php
// Active tout les warning. Utile en phase de d�veloppement
// En phase de production, remplacer E_ALL par 0
error_reporting(E_ALL);
// Inclus le fichier contenant les fonctions personalis�es
include_once '../lib_php/fonctions.php';
// Fonction de connexion � la base de donn�es
//connexion_DB('projetnal');
// D�finit l'Id de la page d'accueil (1 dans cet exemple)
// Pensez � le modifier si ce n'est pas le cas chez vous.
$id_page_accueil = 1;
// R�cup�re l'id de la page courante pass�e par l'URL
// Si non d�fini, on consid�re que la page est la page d'accueil
if (isset($_GET['id_page'])) {
$_ENV['id_page'] = intval($_GET['id_page']);
} else {
$_ENV['id_page'] = $id_page_accueil;
}
// Extrait les informations correspondantes � la page en cours de la DB
//extraction_infos_DB();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<!-- Ins�re les mots-cl�s extraits de la DB dans les meta -->
<META NAME="keywords" lang="fr" CONTENT="<?php //echo $_ENV['mots_cles']; ?>">
<!-- Ins�re la description extraite de la DB dans les meta -->
<META NAME="Description" CONTENT="<?php //echo $_ENV['description']; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- Ins�re le titre extrait de la DB dans la balise correspondante -->
<title><?php //echo $_ENV['titre']; ?></title>
<base href="http://127.0.0.1/nal/" />
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<br>
<table cellpadding='5' width="100%" ><tr><td align='center'>
<B>Cr�pes et galettes � domicile.</B>
</td></tr></table>
<?php //deconnexion_DB(); ?>
</body>
</html>