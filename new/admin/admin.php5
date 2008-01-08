<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document sans titre</title>
    <link rel="stylesheet" type="text/css" href="../interf/stylesheet.css" media="screen" />
</head>
    <body>
        <div class="title">Nouvelle Galette</div>
        <form action="ajouter_admin.php5" method="post">
            <input type="hidden" name = "type" value = "Galette"> 
            <table>
                <tr>
                    <th>Composition</th><th>Ajouter</th>
                </tr>
                <?php
                    require('../outils/outilsBD.php');
                    $res1 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 1 or sucresale = 2) ", 'select','../');
                    $row1 = mysql_fetch_assoc($res1);
                    if ($row1 == 0) {
                        echo "Aucune :)";
                    }
                    while($row1){
                        echo "<tr>";
                        echo "<td>".$row1["ingredient"]."<td\>";
                        echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row1["ingredient"]."\" /></td>";
                        echo "</tr>";
                        
                        $row1 = mysql_fetch_assoc($res1);
                        }
                ?>
              </table>
              <label> Prix </label> <input type="text" name="prix"/>
              <input type="submit" value = "Créer" />
        </form>
        
       <div class="title">Nouvelle Crêpe</div>
        <form action="ajouter_admin.php5" method="post">
            <input type="hidden" name = "type" value = "Crepe">
            <table>
                <tr>
                    <th>Composition</th><th>Ajouter</th>
                </tr>
        
                <?php
                    $res2 = queryDB("SELECT ingredient, prix, sucresale FROM stocks WHERE crepable = 1 and (sucresale = 0 or sucresale = 2) ", 'select','../');
                    $row2 = mysql_fetch_assoc($res2);
                    if ($row2 == 0) {
                        echo "Aucune :)";
                    }
                    while($row2){
                        echo "<tr>";
                        echo "<td>".$row2["ingredient"]."<td\>";
                        echo "<td><input type=\"checkbox\" name=\"ingredient[]\" value=\"".$row2["ingredient"]."\"/></td>";
                        echo "</tr>";
                        $row2 = mysql_fetch_assoc($res2);
                        }
                ?>
             </table>
             <label> Prix </label> <input type="text" name="prix"/>
             <input type="submit" value = "Créer" />
         </form> 
    </body>
</html>
