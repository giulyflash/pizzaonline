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

<div class="title">Votre crepe</div>
<form>
	<table>
	  <tr>
		<th>Composition</th>
		<th>Prix</th>
		<th>Ajouter</th>
	  </tr>
	  <tr>
		<td>fromage</td>
		<td>7,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>tomate</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>jambon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>champignon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	</table>
	<input type="text" value="1" name="custom_crepe_quantite" id="custom_crepe_quantite" />
	<input type="button" value="Ajouter" name="custom_crepe_submit" id="custom_crepe_submit" />
</form>