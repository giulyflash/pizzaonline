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
        <th>Ajouter</th>
      </tr>
		<xsl:apply-templates select="Creperie/Galette"/>
    </table>
    
    <div class="title">Nos Crepes</div>
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
     <div class="title">Nos Desserts</div>
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
             <form action="index.php5?page=ajouter_article" method="post">
                <input type="hidden" name="type" value="Galette" /> 
				<input type="hidden" name="description" value="{$nom}" />
                <input type="hidden" name="id" value="{$nom}" />
                <input type="hidden" name="prix" value="{$prix}" />
				<input type="text" name="quantite" value="1" />
                <input type="image" src="interf/panier.gif" />
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
             <form action="index.php5?page=ajouter_article" method="post">
                <input type="hidden" name="type" value="Crepe" />
				<input type="hidden" name="description" value="{$nom}" />
                <input type="hidden" name="id" value="{$nom}" />
                <input type="hidden" name="prix" value="{$prix}" />
				<input type="text" name="quantite" value="1" />
                <input type="image" src="interf/panier.gif" />
            </form>
            </td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Boisson" >
     	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td><xsl:copy-of select="$prix" /></td>
   			<td>
             <form action="index.php5?page=ajouter_article" method="post">
                <input type="hidden" name="type" value="Boisson" />
				<input type="hidden" name="description" value="{$nom}" />
                <input type="hidden" name="id" value="{$nom}" />
                <input type="hidden" name="prix" value="{$prix}" />
				<input type="text" name="quantite" value="1" />
                <input type="image" src="interf/panier.gif" />
            </form>
            </td>
        </tr>	
	</xsl:template>
     <xsl:template match="Creperie/Dessert" >
     	<xsl:variable name="nom" select="Nom"/>
        <xsl:variable name="prix" select="Prix"/>
        <xsl:variable name="id" select="@id"/>
    	<tr>
            <td><xsl:copy-of select="$nom" /></td>
            <td><xsl:copy-of select="$prix" /></td>
   			<td>
             <form action="index.php5?page=ajouter_article" method="post">
                <input type="hidden" name="type" value="Dessert" />
				<input type="hidden" name="description" value="{$nom}" />
                <input type="hidden" name="id" value="{$nom}" />
                <input type="hidden" name="prix" value="{$prix}" />
				<input type="text" name="quantite" value="1" />
                <input type="image" src="interf/panier.gif" />
            </form>
            </td>
        </tr>	
	</xsl:template>
    <xsl:template match="Ingredients/Ingredient">
    	<xsl:value-of select="."/>&#160;
    </xsl:template>
</xsl:stylesheet>
