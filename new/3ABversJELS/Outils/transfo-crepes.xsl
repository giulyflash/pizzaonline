<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="1.0" >
	<xsl:output encoding="UTF-8" indent="no" />
	<xsl:template match="node()">
		<xsl:copy>
			<xsl:apply-templates select="node()"/>
		</xsl:copy>
	</xsl:template>
	<xsl:template match="//Crepe">
		<xsl:if test="Base='Sucre'">
			<xsl:element name="Crepe">
				<xsl:apply-templates select="Nom"/>
				<xsl:apply-templates select="Ingredients"/>
				<xsl:apply-templates select="Prix"/>
			</xsl:element>
		</xsl:if>
		<xsl:if test="Base='Sel'">
			<xsl:element name="Galette">
				<xsl:apply-templates select="Nom"/>
				<xsl:apply-templates select="Ingredients"/>
				<xsl:apply-templates select="Prix"/>
			</xsl:element>
		</xsl:if>
	</xsl:template>	
</xsl:stylesheet>
