<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="1.0" >
	<!-- rule for the whole document: root element is page -->
	<xsl:template match="Menus">
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
	<xsl:template match="Menus/Titre">
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:apply-templates/>
		</fo:block>
		<xsl:apply-templates select="../Menu"/>
	</xsl:template>
	<!-- Menus -->
	<xsl:template match="Menu">
		<fo:block font-size="36pt" text-align="center" line-height="40pt" space-before="0.5cm" space-after="1.0cm">
			<xsl:text>Menu </xsl:text><xsl:value-of select="Nom"/>
		</fo:block>
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:value-of select="Prix"/><xsl:text> euros</xsl:text>
			<xsl:text> : </xsl:text>
		</fo:block>
		<xsl:apply-templates select="Crepe"/>
		<xsl:apply-templates select="Galette"/>
		<xsl:apply-templates select="Boisson"/>
	</xsl:template>
	<!-- Crepe -->
	<xsl:template match="Crepe">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="."/><xsl:text> Crêpe</xsl:text>
			<xsl:if test="text() &gt; 1">
				<xsl:text>s</xsl:text>
			</xsl:if>
		</fo:block>
	</xsl:template>
	<!-- Galette -->
	<xsl:template match="Galette">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="."/><xsl:text> Galette</xsl:text>
			<xsl:if test="text() &gt; 1">
				<xsl:text>s</xsl:text>
			</xsl:if>
		</fo:block>
	</xsl:template>
	<!-- Boisson -->
	<xsl:template match="Boisson">
		<fo:block text-align="justify"  space-before="0.5cm">
			<xsl:text> - </xsl:text><xsl:value-of select="."/><xsl:text> Boisson</xsl:text>
			<xsl:if test="text() &gt; 1">
				<xsl:text>s</xsl:text>
			</xsl:if>
		</fo:block>
	</xsl:template>
</xsl:stylesheet>
