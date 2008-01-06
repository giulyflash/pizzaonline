<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="1.0" >
	<!-- rule for the whole document: root element is page -->
	<xsl:template match="Creperie">
	<fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
	<fo:layout-master-set>
	<!-- Definition of a single master page. It is simple (no headers etc.) -->
	<fo:simple-page-master master-name="first" margin-left="2cm"  margin-right="2cm" margin-bottom="0.5cm" margin-top="0.75cm" page-width="21cm" page-height="29.7cm">
	<!-- required element body -->
	<fo:region-body />
	</fo:simple-page-master>
	</fo:layout-master-set>
	<!-- Definition of a page sequence -->
	<fo:page-sequence master-reference="first">
	<fo:flow flow-name="xsl-region-body" font-size="14pt" line-height="14pt">
	<xsl:apply-templates select="Titre"/>
	</fo:flow>  
	</fo:page-sequence> 
	</fo:root>
	</xsl:template>
	<!-- A series of XSLT rules that produce fo:blocks to be inserted above -->
	<xsl:template match="Creperie/Titre">
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:apply-templates/>
		</fo:block>
		<!-- Galettes -->
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:text>Galettes :</xsl:text>
		</fo:block>
		<xsl:apply-templates select="../Galette"/>
		<!-- Crepes -->
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:text>Crepes :</xsl:text>
		</fo:block>
		<xsl:apply-templates select="../Crepe"/>
		<!-- Autres desserts -->
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:text>Autres desserts :</xsl:text>
		</fo:block>
		<xsl:apply-templates select="../Dessert"/>
		<!-- Boissons -->
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:text>Boissons :</xsl:text>
		</fo:block>
		<xsl:apply-templates select="../Boisson"/>
	</xsl:template>
	<!-- Galettes -->
	<xsl:template match="Galette">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="Nom"/>
			<xsl:text> (</xsl:text><xsl:value-of select="Prix"/><xsl:text> euros)</xsl:text>
			<xsl:text> : </xsl:text>
			<xsl:for-each select="Ingredients/Ingredient">
				<xsl:apply-templates select="."/>
			</xsl:for-each>
		</fo:block>
	</xsl:template>
	<!-- Crepes -->
	<xsl:template match="Crepe">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="Nom"/>
			<xsl:text> (</xsl:text><xsl:value-of select="Prix"/><xsl:text> euros)</xsl:text>
			<xsl:text> : </xsl:text>
			<xsl:for-each select="Ingredients/Ingredient">
				<xsl:apply-templates select="."/>
			</xsl:for-each>
		</fo:block>
	</xsl:template>
	<!-- Autres desserts -->
	<xsl:template match="Dessert">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="Nom"/>
			<xsl:text> (</xsl:text><xsl:value-of select="Prix"/><xsl:text> euros)</xsl:text>
		</fo:block>
	</xsl:template>
	<!-- Boissons -->
	<xsl:template match="Boisson">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="Nom"/>
			<xsl:text> (</xsl:text><xsl:value-of select="Prix"/><xsl:text> euros)</xsl:text>
		</fo:block>
	</xsl:template>
	<!-- Ingredients -->
	<xsl:template match="Ingredient">
		<xsl:value-of select="text()"/><xsl:text> </xsl:text>
	</xsl:template>
</xsl:stylesheet>
