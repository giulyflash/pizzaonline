<div class="title">Nos menu</div>
<?php
	$xml = new DOMDocument;
	$xml->load("xml/menus.xml");
	
	$xsl = new DOMDocument;
	$xsl->load("xslt/AffMenu.xsl");
	
	// Configuration du transformateur
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl); // attachement des règles xsl
	
	$res=$proc->transformToXML($xml);
	print "$res";
?>
