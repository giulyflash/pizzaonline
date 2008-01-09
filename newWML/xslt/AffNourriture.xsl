<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" encoding="UTF-8"/>
	<xsl:template match="/">
	    <b class="title">Nos Galettes</b>
	    <table>
		    <tr>
			    <td><i>Nom</i></td>
			    <td><i>Composition</i></td>
			    <td><i>Prix</i></td>
		    </tr>
			<xsl:apply-templates select="Creperie/Galette"/>
	    </table>
	    <b class="title">Nos Crepes</b>
	    <table>
		<tr>
			<td><i>Nom</i></td>
			<td><i>Composition</i></td>
			<td><i>Prix</i></td>
		</tr>
		<xsl:apply-templates select="Creperie/Crepe"/>
	    </table>
	    <b class="title">Nos Boissons</b>
	    <table>
		<tr>
			<td><i>Nom</i></td>
			<td><i>Prix</i></td>
		</tr>
		<xsl:apply-templates select="Creperie/Boisson"/>
	    </table>
	    <b class="title">Nos Desserts</b>
	    <table>
			<tr>
				<td><i>Nom</i></td>
				<td><i>Prix</i></td>
			</tr>
			<xsl:apply-templates select="Creperie/Dessert"/>
	    </table>

	</xsl:template> 
	
	<xsl:template match="Creperie/Galette" >
    	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td>
				<xsl:apply-templates select="Ingredients/Ingredient" />
            </td>
            <td><xsl:copy-of select="$prix"/></td>
        </tr>
	</xsl:template>
    <xsl:template match="Creperie/Crepe" >
    	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td>
				<xsl:apply-templates select="Ingredients/Ingredient" />
            </td>
            <td><xsl:copy-of select="$prix"/></td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Boisson" >
     	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td><xsl:copy-of select="$prix" /></td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Dessert" >
     	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td><xsl:copy-of select="$prix" /></td>
        </tr>	
	</xsl:template>
    <xsl:template match="Ingredients/Ingredient">
    	<xsl:value-of select="."/><xsl:text> </xsl:text>
    </xsl:template>
</xsl:stylesheet>
