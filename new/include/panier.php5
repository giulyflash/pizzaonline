<h1>Vos articles</h1>
<?php
	if(empty($_SESSION['panier']['article']))
	{
		echo 'Vous n\'avez pas selectionné d\'article';
	}
	else
	{
		echo '<table>
			<tr>
				<th>
					Type
				</th>
				<th>
					Description
				</th>
				<th>
					Prix
				</th>
				<th>
					Quantité
				</th>
				<th>
					Modification
				</th>
			</tr>';
		foreach($_SESSION['panier']['article'] as $key=>$value)
		{
			echo '<tr>
				<td>
					'.$value['type'].'
				</td>
				<td>
					'.$value['description'].'
				</td>
				<td>
					'.$value['prix'].'
				</td>
				<td>
					'.$value['quantite'].'
				</td>
				<td>
					<form action="index.php5?page=modifier_article" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="reduire" />
						<input type="image" class="modif" src="interf/panier_reduire.png" />
					</form>
					<form action="index.php5?page=modifier_article" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="augmenter" />
						<input type="image" class="modif" src="interf/panier_augmenter.png" />
					</form>
					<form action="index.php5?page=modifier_article" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="supprimer" />
						<input type="image" class="modif" src="interf/panier_supprimer.png" />
					</form>
				</td>
			</tr>';
		}
		echo '</table>';
	}
?>
<h1>Vos menu</h1>
<?php
	if(empty($_SESSION['panier']['menu']))
	{
		echo 'Vous n\'avez selectionne aucun article';
	}
	else{
		foreach($_SESSION['panier']['menu'] as $key=>$value)
		{
			echo '<table>';
			echo '<tr>
				<th>
					Menu '.$value['nommenu'].'
				</th>
				<th>
					Prix '.$value['prix'].'
				</th>
			</tr>';
			if(empty($value['nbgalette'])) $nbgalette = 0;
			else $nbgalette = intval($value['nbgalette']);
			for($i=0;$i<$nbgalette;$i++)
			{
				
				echo '<tr>
					<td>
						Galette n°'.($i+1).'
					</td>
					<td>
						'.$value['galette'.($i+1)].'
					</td>
				</tr>';
			}
			if(empty($value['nbcrepe'])) $nbcrepe = 0;
			else $nbcrepe = intval($value['nbcrepe']);
			for($i=0;$i<$nbcrepe;$i++)
			{
				
				echo '<tr>
					<td>
						Crepe n°'.($i+1).'
					</td>
					<td>
						'.$value['crepe'.($i+1)].'
					</td>
				</tr>';
			}
			if(empty($value['nbdessert'])) $nbdessert = 0;
			else $nbdessert = intval($value['nbdessert']);
			for($i=0;$i<$nbdessert;$i++)
			{
				
				echo '<tr>
					<td>
						Dessert n°'.($i+1).'
					</td>
					<td>
						'.$value['dessert'.($i+1)].'
					</td>
				</tr>';
			}
			if(empty($value['nbboisson'])) $nbboisson = 0;
			else $nbboisson = intval($value['nbboisson']);
			for($i=0;$i<$nbboisson;$i++)
			{
				
				echo '<tr>
					<td>
						Boisson n°'.($i+1).'
					</td>
					<td>
						'.$value['boisson'.($i+1)].'
					</td>
				</tr>';
			}
			echo '
				<tr>
				<td>
					Quantité : '.$value['quantite'].'
				</td>
				<td>
					<form action="index.php5?page=modifier_menu" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="reduire" />
						<input type="image" class="modif" src="interf/panier_reduire.png" />
					</form>
					<form action="index.php5?page=modifier_menu" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="augmenter" />
						<input type="image" class="modif" src="interf/panier_augmenter.png" />
					</form>
					<form action="index.php5?page=modifier_menu" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="supprimer" />
						<input type="image" class="modif" src="interf/panier_supprimer.png" />
					</form>
				</td>
				</tr>';
			echo '</table>';
		}
		
	}
?>
<h1>Vos crepes persos</h1>
<?php
	if(empty($_SESSION['panier']['perso']))
	{
		echo 'Vous n\'avez selectionne aucune crepe personalisee';
	}
	else
	{
		echo '<table>
			<tr>
				<th>
					Type
				</th>
				<th>
					Description
				</th>
				<th>
					Prix
				</th>
				<th>
					Quantité
				</th>
				<th>
					Modification
				</th>
			</tr>';
		foreach($_SESSION['panier']['perso'] as $key=>$value)
		{
			echo '<tr>
				<td>
					'.$value['type'].'
				</td>
				<td>
					';
			foreach($_SESSION['panier']['perso'][$key]['ingredient'] as $ingredient)
			{
				echo $ingredient.' ';
			}
			echo '</td>
				<td>
					'.$value['prix'].'
				</td>
				<td>
					'.$value['quantite'].'
				</td>
				<td>
					<form action="index.php5?page=modifier_perso" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="reduire" />
						<input type="image" class="modif" src="interf/panier_reduire.png" />
					</form>
					<form action="index.php5?page=modifier_perso" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="augmenter" />
						<input type="image" class="modif" src="interf/panier_augmenter.png" />
					</form>
					<form action="index.php5?page=modifier_perso" method="post">
						<input type="hidden" name="id" value="'.$key.'" />
						<input type="hidden" name="type" value="supprimer" />
						<input type="image" class="modif" src="interf/panier_supprimer.png" />
					</form>
				</td>
			</tr>';
		}
		echo '</table>';
	}
?>
<br />
<a class="nav_button" href="index.php5?page=valider_commande">Commander</a>
<a class="nav_button" href="index.php5?page=vider_panier">Vider</a>
<a class="nav_button" href="index.php5?page=vider_panier&type=article">Vider les articles</a>
<a class="nav_button" href="index.php5?page=vider_panier&type=menu">Vider les menus</a>
<a class="nav_button" href="index.php5?page=vider_panier&type=perso">Vider les personnalisées</a>