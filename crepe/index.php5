<?php
	require('param.php5');
	require('framework/bd.php5');
	require('include.php5');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="interf/stylesheet.css" media="screen" />
    </head>
    <body>
    	<div id="main_content">
            <div id="header">
            </div>
            <div id="nav">
            	<div id="login_header">
                	Login
                </div>
                <div id="login_content">
                	<?php
						if($connecte)
						{
							echo 'Vous etes connectes en tant que : <a href="index.php5?page=profil">'.$login_name.'</a><br />
					<a href="index.php5?page=deconnexion">Se deconnecter</a>';
						}
						else
						{
							echo '<form action="index.php5?page=connexion" method="post">
						<label for="login_name">Login</label>
						<input type="text" name="login_name" id="login_name" />
						<label for="login_name">Mot de passe</label>
						<input type="password" name="login_pass" id="login_pass" />
						<input type="submit" id="login_submit" value="S\'identifier" />
					</form>
                    <a href="index.php5?page=inscription">S\'inscrire</a>';
						}
					?>
                </div>
            	<div id="login_footer">
                </div>
            	<div id="nav_header">
                	Menu
                </div>
                <div id="nav_content">
                    <ul>
                        <li><a href="index.php5?page=accueil">Accueil</a></li>
                        <li><a href="index.php5?page=menu">Nos menus</a></li>
                        <li><a href="index.php5?page=noscrepe">Nos Galettes<br />/Crepes</a></li>
                        <li><a href="index.php5?page=voscrepe">Vos Galettes<br />/Crepes</a></li>
                        <li><a href="index.php5?page=recherche">Rechercher</a></li>
                        <li><a href="index.php5?page=panier">Votre panier</a></li>
                    </ul>
                </div>
            	<div id="nav_footer">
                </div>
            </div>
            <div id="content">
            	<?php include($page); ?>
            </div>
            <div id="footer">
                "La NAL, c'est bon, mangez-en!"©
            </div>
        </div>
    </body>
</html>
