<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="xml" encoding="UTF-8"/>

	<xsl:template match="/">
    <div class="title">Nos Galettes</div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Composition</th>
        <th>Prix</th>
        <th>Ajouter</th>
      </tr>
		<xsl:apply-templates select="Creperie/Galette"/>
    </table>
    
    <div class="title">Nos Crêpes</div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Composition</th>
        <th>Prix</th>
        <th>Ajouter</th>
      </tr>
		<xsl:apply-templates select="Creperie/Crepe"/>
    </table>
    
    <div class="title">Nos Boissons</div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Ajouter</th>
      </tr>
		<xsl:apply-templates select="Creperie/Boisson"/>
    </table>
     <div class="title">Nos Déssert</div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Ajouter</th>
      </tr>
		<xsl:apply-templates select="Creperie/Dessert"/>
    </table>
	</xsl:template>
	
	<xsl:template match="Creperie/Galette" >
    	<tr>
            <td><xsl:value-of select="Nom"/></td>
            <td>
            <xsl:apply-templates select="Ingredients/Ingredient" />
            </td>
            <td><xsl:value-of select="Prix"/></td>
   			<td><input type="text" name="quantite_2" id="quantite_2" value="1" /><img src="interf/panier.gif" /></td>
        </tr>	
	</xsl:template>
    <xsl:template match="Creperie/Crepe" >
    	<tr>
            <td><xsl:value-of select="Nom"/></td>
            <td>
            <xsl:apply-templates select="Ingredients/Ingredient" />
            </td>
            <td><xsl:value-of select="Prix"/></td>
   			<td><input type="text" name="quantite_3" id="quantite_3" value="1" /><img src="interf/panier.gif" /></td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Boisson" >
    	<tr>
            <td><xsl:value-of select="Nom"/></td>
            <td><xsl:value-of select="Prix"/></td>
   			<td><input type="text" name="quantite_4" id="quantite_4" value="1" /><img src="interf/panier.gif" /></td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Dessert" >
    	<tr>
            <td><xsl:value-of select="Nom"/></td>
            <td><xsl:value-of select="Prix"/></td>
   			<td><input type="text" name="quantite_5" id="quantite_5" value="1" /><img src="interf/panier.gif" /></td>
        </tr>	
	</xsl:template>
    <xsl:template match="Ingredients/Ingredient">
    	<xsl:value-of select="."/>&#160;
    </xsl:template>

</xsl:stylesheet>
