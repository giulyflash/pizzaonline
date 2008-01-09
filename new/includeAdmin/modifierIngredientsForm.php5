<div class="title">Mise à jours des quantitées</div>
    <table>
        <tr>
            <th>Ingredient</th><th>Quantite actuel</th><th>Mise à jours stock</th>
        </tr>
        <?php
            require('outils/outilsBD.php');
            $res1 = queryDB("SELECT ingredient, quantite FROM stocks", 'select');
            $row1 = mysql_fetch_assoc($res1);
            if ($row1 == 0) {
                echo "Aucune :)";
            }
            while($row1){
                echo "<tr>";
                echo "<td>".$row1["ingredient"]."<td\>";
				echo "<td>".$row1["quantite"]."<td\>";
                echo "<td><form action=\"indexAdmin.php5?page=miseAjourIngredient\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"nomItem\" value=\"".$row1["ingredient"]."\" />";
				echo "<input type=\"hidden\" name=\"quantiteItem\" value=\"".$row1["quantite"]."\" />";
				echo "<input type=\"text\"  name = \"valItem\"  />";
                echo "<input type=\"submit\" value = \"ajout\" />";
            	echo "</form></td>";
                echo "</tr>";
                
                $row1 = mysql_fetch_assoc($res1);
                }
        ?>
	</table>
    
<div class="title">Ajouter de nouveau ingrédients</div>
