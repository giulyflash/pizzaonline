<div class="title">Recherche</div>
Ingredients
<select>
	<option value="id_1">Tomate</option>
    <option value="id_2">Fromage</option>
</select>

<div class="title">Nos crepes</div>
<table>
  <tr>
    <th>Nom</th>
    <th>Composition</th>
    <th>Prix</th>
    <th>Ajouter</th>
  </tr>
  <tr>
    <td>Margarita</td>
    <td>fromage, tomate, olive</td>
    <td>7,00</td>
    <td>
    	<form action="index.php5?page=ajouter_article" method="post">
        	<input type="hidden" name="type" id="tpye_1" value="crepe" />
        	<input type="hidden" name="id" id="id_1" value="1" />
            <input type="hidden" name="description" id="description_1" value="Margarita" />
        	<input type="hidden" name="prix" id="prix_1" value="7,00" />
    		<input type="text" name="quantite" id="quantite_1" value="1" />
            <input type="image" src="interf/panier.gif" />
        </form>
    </td>
  </tr>
  <tr>
    <td>Reine</td>
    <td>jambon, champignon, fromage, tomate, olive</td>
    <td>9,00</td>
    <td><input type="text" name="quantite_2" id="quantite_2" value="1" /><img src="interf/panier.gif" /></td>
  </tr>
</table>

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
      	<td colspan="3">Prix : <input disabled="disabled" type="text" name="prix" id="custom_crepe_prix" value="0" /></td>
      </tr>
      <tr>
      	<td colspan="3">Quantite : <input type="text" value="1" name="quantite" id="custom_crepe_quantite" /> <input type="image" src="interf/panier.gif" /></td>
      </tr>
	</table>
</form>