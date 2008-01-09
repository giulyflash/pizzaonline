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
            <div id="nav">
            	<b id="nav_header">
                	Menu
                </b>
				<br/>
                <div id="nav_content">
					<a href="index.php5?page=accueil">Accueil</a><br/>
					<a href="index.php5?page=menu">Nos menus</a><br/>
					<a href="index.php5?page=noscrepes">Nos Galettes et Crepes</a><br/>
					<a href="index.php5?page=voscrepes">Vos Galettes et Crepes</a><br/>
                </div>
            </div>
			<br/>
            <div id="footer">
                Site cree par Laurent Gautho-lapeyre, Jennifer Henry, Sandie Ogier, Erwan Pinault
            </div>
        </div>
    </card>
</wml>
