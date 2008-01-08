<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" encoding="UTF-8"/>


	<xsl:template match="/">
    <div class="title">Nos Galettes</div>
    <table>
      <tr>
        <th>Nom </th>
        <th>Composition</th>
        <th>Prix</th>
      </tr>
		<xsl:apply-templates select="Creperie/Galette"/>
    </table>
    
    <div class="title">Nos Crêpes</div>
    <table>
      <tr>
        <th>Nom</th>
        <th>Composition</th>
        <th>Prix</th>
      </tr>
		<xsl:apply-templates select="Creperie/Crepe"/>
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
            <td>
            <form action="indexAdmin.php5?page=formModifierGalette" method="post">
                <input type="hidden" name="nomItem" value="{$nom}" />
                <input type="hidden" name="typeItem" value="Galette" />
                <input type="image" class="modif" src="interf/b_edit.png" />
            </form>
            <form action="includeAdmin/supprimerCrepesTraitement.php5" method="post">
            	<input type="hidden" name="nomItem" value="{$nom}" />
                <input type="hidden" name="typeItem" value="Galette" />
                <input type="image" class="modif" src="interf/b_drop.png" />
            </form>
            </td>
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
   			 <td>
              <form action="indexAdmin.php5?page=formModifierCrepe" method="post">
                <input type="hidden" name="nomItem" value="{$nom}" />
                <input type="hidden" name="typeItem" value="Crepe" />
                <input type="image" class="modif" src="interf/b_edit.png" />
            </form>
            <form action="includeAdmin/supprimerCrepesTraitement.php5" method="post">
            	<input type="hidden" name="nomItem" value="{$nom}" />
                <input type="hidden" name="typeItem" value="Crepe" />
                <input type="image" class="modif" src="interf/b_drop.png" />
            </form>
            </td>
        </tr>	
	</xsl:template>
    <xsl:template match="Ingredients/Ingredient">
    	<xsl:value-of select="."/>&#160;
    </xsl:template>
</xsl:stylesheet>
