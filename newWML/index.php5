<?php
	require('param.php5');
	require('framework/bd.php5');
	require('include.php5');
?>

<?php
	header("Content-Type: text/vnd.wap.wml");
	echo '<?xml version="1.0" encoding="iso-8859-1"?>';
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN" "http://www.wapforum.org/DTD/wml_1.1.xml">
<wml>
    <card id="card1" title="Accueil">
    	<div id="main_content">
            <div id="header">
            </div>
            <div id="content">
            	<?php include($page); ?>
            </div>
			<br/>
			<br/>
            <div id="nav">
            	<b id="login_header">
                	Login
                </b>
				<br/>
                <div id="login_content">
                	<?php
						if($connecte)
						{
							echo 'Vous etes connectes en tant que : <a href="index.php5?page=profil">'.$login_name.'</a><br />
							<img src="interf/historique.png" /> <a href="index.php5?page=historique">Historique</a><br/>
							<img src="interf/logout.png" /> <a href="index.php5?page=deconnexion">Deconnexion</a>';
						}
						else
						{
							echo '<form action="index.php5?page=connexion" method="post">
							<label for="login_name">Login</label>
							<input type="text" name="login_name" id="login_name" />
							<label for="login_name">Mot de passe</label>
							<input type="password" name="login_pass" id="login_pass" />
							<input type="submit" id="login_submit" value="S identifier" />
							</form>
		                    <img src="interf/inscrire.png" /> <a href="index.php5?page=inscription">S\'inscrire</a>';
						}
					?>
                </div>
				<br/>
				<br/>
            	<b id="nav_header">
                	Menu
                </b>
				<br/>
                <div id="nav_content">
					<a href="index.php5?page=accueil">Accueil</a><br/>
					<a href="index.php5?page=menu">Nos menus</a><br/>
					<a href="index.php5?page=noscrepes">Nos Galettes/Crepes</a><br/>
					<a href="index.php5?page=voscrepes">Vos Galettes/Crepes</a><br/>
					<a href="index.php5?page=recherche">Rechercher</a><br/>
					<a href="index.php5?page=panier">Votre panier</a><br/>
                </div>
            </div>
			<br/>
            <div id="footer">
                Site cree par Laurent Gautho-lapeyre, Jennifer Henry, Sandie Ogier, Erwan Pinault
            </div>
        </div>
    </card>
</wml>
