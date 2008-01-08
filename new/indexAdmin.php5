<?php
	require('param.php5');
	require('framework/bd.php5');
	require('includeAdmin.php5');
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
            <div id="headerAdmin">            </div>
            <div id="nav">
            	<div id="nav_header">
                	Menu                </div>
                <div id="nav_content">
                    <ul>
                        <li><a href="indexAdmin.php5?page=commandes">Commandes</a></li>
                        <li><a href="indexAdmin.php5?page=ajouterCrepes">Ajouter Galettes<br />/Crepes</a></li>
                        <li><a href="indexAdmin.php5?page=modifierSupprimerCrepes">Modifier Galettes<br />/Crepes</a></li>
                    </ul>
                </div>
            	<div id="nav_footer"></div>
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
