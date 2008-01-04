<div class="title">Nos menu</div>
<table>
  <tr>
    <th>Menu</th>
    <th>Galette</th>
    <th>Crepe</th>
	<th>Boisson</th>
    <th>Prix</th>
    <th>Ajouter</th>
  </tr>
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
</table>