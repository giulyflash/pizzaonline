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
					Type
				</th>
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
<div class="title">Vos crepes persos</div>