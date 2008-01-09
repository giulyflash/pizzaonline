<b>Ingredients possibles pour votre galette personnalisee</b>
<table>
	<tr>
		<td><i>Composition</i></td><td><i>Prix</i></td>
	</tr>
	<?php
		require('outils/outilsBD.php');
		$res1 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 1 or sucresale = 2) ", 'select');
		$row1 = mysql_fetch_assoc($res1);
		if ($row1 == 0) {
			echo "Aucune :)";
		}
		while($row1){
			echo "<tr>";
			echo "<td>".$row1["ingredient"]."</td>";
			echo "<td>".$row1["prix"]."</td>";
			echo "</tr>";
			
			$row1 = mysql_fetch_assoc($res1);
		}
	?>
</table>
<br/>
<b>Ingredients possibles pour votre crepe personnalisee</b>
<table>
	<tr>
		<td><i>Composition</i></td><td><i>Prix</i></td>
	</tr>

	<?php
		$res2 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 0 or sucresale = 2) ", 'select');
		$row2 = mysql_fetch_assoc($res2);
		if ($row2 == 0) {
			echo "Aucune :)";
		}
		while($row2){
			echo "<tr>";
			echo "<td>".$row2["ingredient"]."</td>";
			echo "<td>".$row2["prix"]."</td>";
			echo "</tr>";
			$row2 = mysql_fetch_assoc($res2);
		}
	?>
 </table>
