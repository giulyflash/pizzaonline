<?php
	$xml = new DOMDocument;
	$xml->load("xml/nourriture.xml");
	
	$xsl = new DOMDocument;
	$xsl->load("xslt/AffModifierSupprimerNourriture.xsl");
	
	// Configuration du transformateur
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl); 	
	$res=$proc->transformToXML($xml);
	print "$res";
?>
