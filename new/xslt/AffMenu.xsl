<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="xml" encoding="ISO-8859-1"/>

	<xsl:template match="Menus">
    <table>
        <tr>
        <th>Menu</th>
        <th>Galette</th>
        <th>Crepe</th>
        <th>Boisson</th>
        <th>Prix</th>
        <th>Ajouter</th>
        </tr>
		<xsl:apply-templates select="Menu"/>
        </table>
	</xsl:template>
	
	<xsl:template match="Menu" >
    	<tr>
            <td><xsl:value-of select="Nom"/></td>
            <td><xsl:value-of select="Galette"/></td>
            <td><xsl:value-of select="Crepe"/></td>
            <td><xsl:value-of select="Boisson"/></td>
            <td><xsl:value-of select="Prix"/></td>
            <td><input type="text" name="quantite_1" id="quantite_1" value="1" /><img src="interf/panier.gif" /></td>
        </tr>	
	</xsl:template>

</xsl:stylesheet>