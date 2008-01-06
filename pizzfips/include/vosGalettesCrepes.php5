<div class="title">Votre crepe</div>
<script type="text/javascript">
	var prix_ingredient=new Array();
	var prix=0;
	
	function maj_prix(obj,cout)
	{
		if(obj.checked)
		{
			prix+=cout;
		}
		else
		{
			prix-=cout;
		}
		document.getElementById('custom_crepe_prix_affiche').value=prix;
		document.getElementById('custom_crepe_prix').value=prix;
	}
</script>
<form action="index.php5?page=ajouter_perso" method="post">
	<table>
	  <tr>
		<th>Composition</th>
		<th>Prix</th>
		<th>Ajouter</th>
	  </tr>
	  <tr>
		<td>fromage</td>
		<td>7,00</td>
		<td><input type="checkbox" name="ingredient[]" value="fromage" onclick="maj_prix(this,7.00);" /></td>
	  </tr>
	  <tr>
		<td>tomate</td>
		<td>9,00</td>
		<td><input type="checkbox" name="ingredient[]" value="tomate" onclick="maj_prix(this,9.00);" /></td>
	  </tr>
	  <tr>
		<td>jambon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="ingredient[]" value="jambon" onclick="maj_prix(this,9.00);" /></td>
	  </tr>
	  <tr>
		<td>champignon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="ingredient[]" value="champignon" onclick="maj_prix(this,9.00);" /></td>
	  </tr>
      <tr>
      	<td colspan="3">Prix : <input type="text"id="custom_crepe_prix_affiche" value="0" disabled="disabled" /><input type="hidden" id="custom_crepe_prix" name="prix" value="0" /></td>
      </tr>
      <tr>
      	<td colspan="3">Quantite : <input type="text" value="1" name="quantite" id="custom_crepe_quantite" /> <input type="image" src="interf/panier.gif" /></td>
      </tr>
	</table>
</form>