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
		foreach($_SESSION['panier']['article'] as $value)
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
			</tr>';
		}
		echo '</table>';
	}
?>
<div class="title">Vos menu</div>
<div class="title">Vos crepes persos</div>