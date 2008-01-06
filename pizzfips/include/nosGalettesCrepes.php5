<div class="title">Recherche</div>
Ingredients
<select>
	<option value="id_1">Tomate</option>
    <option value="id_2">Fromage</option>
</select>

<?php
		$xml = new DOMDocument;
		$xml->load("xml/nouriture.xml");
		
		$xsl = new DOMDocument;
		$xsl->load("xslt/AffNouriture.xsl");
		
		// Configuration du transformateur
		$proc = new XSLTProcessor;
		$proc->importStyleSheet($xsl); // attachement des règles xsl
		
		$res=$proc->transformToXML($xml);
		print "$res";
?>
