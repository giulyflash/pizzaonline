<div class="title">Modification</div>
<form action="indexAdmin.php5?page=modifierCrepesTraitement" method="post">
    <input type="hidden" name = "type" value = "Galette"> 
    <table>
        <tr>
            <th>Composition</th><th>Ajouter</th>
        </tr>
        <?php
            require('outils/outilsBD.php');
			$dom = new DomDocument();
			$dom->load('xml/nourriture.xml');
			$xpath = new Domxpath($dom);

			$typeItem = $_POST['typeItem'];
			$nom = $_POST['nomItem'];
			$racine = $dom->documentElement;

			$result1 = $xpath->query("//Galette [Nom='$nom']/Prix");
			foreach ($result1 as $ing) {
				$prix = $ing->nodeValue;  
			}
            $res1 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 1 or sucresale = 2) ", 'select');
            $row1 = mysql_fetch_assoc($res1);
            if ($row1 == 0) {
                echo "Erreur aucun ingredients présent en base";
            }
            while($row2){
				$ingre = $row2["ingredient"];
                echo "<tr>";
                echo "<td>".$row2["ingredient"]."<td\>";
				$result = $xpath->query("//Galette [Nom='$nom']/Ingredients[Ingredient = '$ingre']");
				if($result->length != 0) 
				{
					echo "<td><input type=\"checkbox\" checked=\"checked\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\"/></td>";
				}
				else 
				{
					echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\"/></td>";
				}
            
                echo "</tr>";
                $row2 = mysql_fetch_assoc($res2);
                }
			echo "</table>";
     		echo "<label> Nom </label> <input type='text' name='nom' value='$nom'/>";
     		echo "<label> Prix </label> <input type='text' name='prix' value='$prix'/>";
			
			$result2 = $xpath->query("//Galette [Nom='$nom']");
			foreach ($result2 as $ing2) {
				$racine->removeChild($ing2);  
			}
			$dom->save('xml/nourriture.xml');
        ?>
      <input type="submit" value = "Modifier" />
</form> 

	
	