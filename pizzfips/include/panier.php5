<div class="title">Vos articles</div>
<?php
	if(empty($_SESSION['panier']['article']))
	{
		echo 'Vous n\'avez selectionne aucun article';
	}
	else
	{
		echo '<table>
			<tr>
				<th>
					type
				</th>
				<th>
					description
				</th>
				<th>
					prix
				</th>
				<th>
					quantite
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
<div class="title">Vos menu</div>
<?php
	if(empty($_SESSION['panier']['menu']))
	{
		echo 'Vous n\'avez selectionne aucun article';
	}
	else{
		foreach($_SESSION['panier']['menu'] as $value)
		{
			echo '<table>';
			echo '<tr>
				<td>
					'.$value['nommenu'].'
				</td>
				<td>
					'.$value['prix'].'
				</td>
			</tr>';
			if(empty($value['nbgalette'])) $nbgalette = 0;
			else $nbgalette = intval($value['nbgalette']);
			for($i=0;$i<$nbgalette;$i++)
			{
				
				echo '<tr>
					<td>
						Galette
					</td>
					<td>
						'.$value['galette'.($i+1)].'
					</td>
				</tr>';
			}
			if(empty($value['nbcrepe'])) $nbcrepe = 0;
			else $nbcrepe = intval($value['nbgalette']);
			for($i=0;$i<$nbcrepe;$i++)
			{
				
				echo '<tr>
					<td>
						Crepe
					</td>
					<td>
						'.$value['crepe'.($i+1)].'
					</td>
				</tr>';
			}
			if(empty($value['nbboisson'])) $nbboisson = 0;
			else $nbboisson = intval($value['nbboisson']);
			for($i=0;$i<$nbboisson;$i++)
			{
				
				echo '<tr>
					<td>
						Boisson
					</td>
					<td>
						'.$value['boisson'.($i+1)].'
					</td>
				</tr>';
			}
			echo '</table>';
		}
		
	}
?>
<div class="title">Vos crepes persos</div>
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
					Description
				</th>
				<th>
					Prix
				</th>
				<th>
					Quantite
				</th>
				<th>
					Modification
				</th>
			</tr>';
		foreach($_SESSION['panier']['perso'] as $key=>$value)
		{
			echo '<tr>
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