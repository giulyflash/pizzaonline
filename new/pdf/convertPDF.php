<?php
	echo 'Création de PDF<br/>';
	//echo exec ("./fop-0.94/fop -xml ./toto.xml -xsl ./toto.xsl ./toto.pdf", $ret);
	echo passthru ('runfop.bat', $ret);
	echo '<br/>';
	echo $ret;
	echo '<br/>';
	echo 'PDF créé<br/>';
?>