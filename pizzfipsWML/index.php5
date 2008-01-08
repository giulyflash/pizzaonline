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
            <p id="content">
            	<?php include($page); ?>
            </p>
            <p id="nav">
				<p id="login">
	            	<b id="login_header">
	                	------------------<br/>
	                	Login<br/>
	                </b>
	                <div id="login_content">
	                	<?php
							if($connecte)
							{
								echo 'Vous etes connectes en tant que :'.$login_name.
								'<a href="index.php5?page=deconnexion">Se deconnecter</a>';
							}
							else
							{
								echo '<form action="index.php5?page=connexion" method="post">
								<label for="login_name">Login</label>
								<input type="text" name="login_name" id="login_name" /><br/>
								<label for="login_name">Mot de passe</label>
								<input type="password" name="login_pass" id="login_pass" /><br/>
								<input type="submit" id="login_submit" value="S\'identifier" /><br/>
								</form>
			                    <a href="index.php5?page=inscription">S\'inscrire</a>';
							}
						?>
						<br/>
	                </div>
	            	<b id="login_footer">
	                	------------------<br/>
	                </b>
				</p>
				<p id="menu">
	            	<b id="nav_header">
	                	------------------<br/>
	                	Menu<br/>
	                </b>
	                <div id="nav_content">
						<a href="index.php5?page=accueil">Accueil</a><br/>
						<a href="index.php5?page=menu">Nos menus</a><br/>
						<a href="index.php5?page=crepe">Nos crepes</a><br/>
						<a href="index.php5?page=panier">Votre panier</a><br/>
	                </div>
	            	<b id="nav_footer">
	                	------------------<br/>
	                </b>
				</p>
            </p>
            <p id="footer">
                "La NAL, c'est bon, mangez-en!"©
            </p>
        </div>
    </card>
</wml>
