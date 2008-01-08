<div class="title">Recherche</div>
Ingredients
<select>
	<option value="id_1">Tomate</option>
    <option value="id_2">Fromage</option>
</select>

<div class="title">Nos pizzas</div>
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
    <td><input type="text" name="quantite_1" id="quantite_1" value="1" /><img src="interf/panier.gif" /></td>
  </tr>
  <tr>
    <td>Reine</td>
    <td>jambon, champignon, fromage, tomate, olive</td>
    <td>9,00</td>
    <td><input type="text" name="quantite_2" id="quantite_2" value="1" /><img src="interf/panier.gif" /></td>
  </tr>
</table>

<div class="title">Votre pizza</div>
<form>
	<table>
	  <tr>
		<th>Composition</th>
		<th>Prix</th>
		<th>Ajouter</th>
	  </tr>
	  <tr>
		<td>fromage</td>
		<td>7,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>tomate</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>jambon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	  <tr>
		<td>champignon</td>
		<td>9,00</td>
		<td><input type="checkbox" name="checkbox" id="checkbox" /></td>
	  </tr>
	</table>
	<input type="text" value="1" name="custom_pizza_quantite" id="custom_pizza_quantite" />
	<input type="button" value="Ajouter" name="custom_pizza_submit" id="custom_pizza_submit" />
</form>