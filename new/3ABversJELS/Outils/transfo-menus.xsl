<?xml version="1.0" encoding="ISO-8859-1"?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="1.0" >
	<xsl:output encoding="UTF-8" indent="no" />
	<xsl:template match="node()">
		<xsl:copy>
			<xsl:apply-templates select="node()"/>
		</xsl:copy>
	</xsl:template>
	<xsl:template match="//CrepeSalee">
		<xsl:element name="Galette">
			<xsl:value-of select="."/>
		</xsl:element>
	</xsl:template>	
	<xsl:template match="//CrepeSucree">
		<xsl:element name="Crepe">
			<xsl:value-of select="."/>
		</xsl:element>
	</xsl:template>	
	<xsl:template match="//Item"> <!-- Tous les items (boissons et desserts) sont insérés en tant que boissons -->
		<xsl:element name="Boisson">
			<xsl:value-of select="."/>
		</xsl:element>
	</xsl:template>	
</xsl:stylesheet>
