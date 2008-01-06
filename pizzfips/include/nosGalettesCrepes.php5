<?php
	$xml = new DOMDocument;
	$xml->load("xml/nourriture.xml");
	
	$xsl = new DOMDocument;
	$xsl->load("xslt/AffNourriture.xsl");
	
	// Configuration du transformateur
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl); // attachement des r�gles xsl
	
	$res=$proc->transformToXML($xml);
	print "$res";
?>