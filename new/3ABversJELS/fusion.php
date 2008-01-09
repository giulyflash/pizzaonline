<?php
    include('Outils/configuration.php');
    connexionBD();
    // CREPES ///////////////////////////////////////////////////////////////////////////
    // transformation du fichier 3AB au format JELS
    $xml = new DOMDocument;
    $xml->load("3AB/Crepe.xml");
    $xsl = new DOMDocument;
    $xsl->load("Outils/transfo-crepes.xsl");
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
    $res=$proc->transformToXML($xml);
    // fusion des 2 fichiers
    $xmlOut = fopen("Outils/3ab-crepe-transforme.xml", "w");
    fwrite($xmlOut, $res); 
    fclose($xmlOut);
    $xmlIn = fopen("Fusion/crepe-fusion.xml", "w");
    if (!$xmlIn) echo "Pas de fichier crepe-fusion.xml";
    fwrite($xmlIn, "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<Creperie>\n");
    lireEtEcrire("Outils/3ab-crepe-transforme.xml", $xmlIn, "Crepes");
    lireEtEcrire("JELS/nourriture.xml", $xmlIn, "Creperie");
    // boissons
    $res = envoiRequete ("SELECT * FROM `la-galette-orceenne`.boissons");
    $row = mysql_fetch_assoc($res);
    while($row){
        $nom = $row["nom"];
        fwrite($xmlIn, "\t<Boisson>\n\t\t<Nom>$nom</Nom>\n\t\t<Prix>2,00</Prix>\n\t</Boisson>\n");
        $row = mysql_fetch_assoc($res);
    }
    // desserts
    $res = envoiRequete ("SELECT * FROM `la-galette-orceenne`.desserts");
    $row = mysql_fetch_assoc($res);
    while($row){
        $nom = $row["nom"];
        fwrite($xmlIn, "\t<Dessert>\n\t\t<Nom>$nom</Nom>\n\t\t<Prix>4,00</Prix>\n\t</Dessert>\n");
        $row = mysql_fetch_assoc($res);
    }
    fwrite($xmlIn, "</Creperie>\n");
    // MENUS ///////////////////////////////////////////////////////////////////////////
    // transformation du fichier 3AB au format JELS
    $xml = new DOMDocument;
    $xml->load("3AB/menu.xml");
    $xsl = new DOMDocument;
    $xsl->load("Outils/transfo-menus.xsl");
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
    $res=$proc->transformToXML($xml);
    // fusion des 2 fichiers
    $xmlOut = fopen("Outils/3ab-menu-transforme.xml", "w");
    fwrite($xmlOut, $res); 
    fclose($xmlOut);
    $xmlIn = fopen("Fusion/menu-fusion.xml", "w");
    if (!$xmlIn) echo "Pas de fichier menu-fusion.xml";
    fwrite($xmlIn, "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<Menus>\n");
    lireEtEcrire("Outils/3ab-menu-transforme.xml", $xmlIn, "Menus");
    lireEtEcrire("JELS/menus.xml", $xmlIn, "Menus");
    fwrite($xmlIn, "</Menus>\n");
    // CLIENTS ///////////////////////////////////////////////////////////////////////
    envoiRequete (
        "INSERT INTO crepes2.client "
        ."SELECT '', courriel, mdp, nom, prenom, CONCAT(adresse1,' ',adresse2), cp, ville, tel "
        ."FROM `la-galette-orceenne`.clients"
        ."WHERE courriel NOT IN (SELECT login FROM crepes2.clients)"
    );
    // STOCKS D'INGREDIENTS /////////////////////////////////////////////////////////   
    envoiRequete (
        "INSERT INTO crepes2.stocks "
        ."SELECT nom, quantite, 10, 1, 2, IF(base='sel',1,0) " // ingr, qte, seuil, crepable, px, sucre
        ."FROM `la-galette-orceenne`.ingredients "
        ."WHERE nom NOT IN (SELECT ingredient FROM crepes2.stocks)"
    );
    // STOCKS DE DESSERTS ///////////////////////////////////////////////////////// 
    envoiRequete (
        "INSERT INTO crepes2.stocks "
        ."SELECT nom, quantite, 10, 0, 3, 0 " // ingr, qte, seuil, crepable, px, sucre
        ."FROM `la-galette-orceenne`.desserts "
        ."WHERE nom NOT IN (SELECT ingredient FROM crepes2.stocks)"
    );
    // STOCKS DE BOISSONS /////////////////////////////////////////////////////////
    envoiRequete (
        "INSERT INTO crepes2.stocks "
        ."SELECT nom, quantite, 10, 0, 2, 0 " // ingr, qte, seuil, crepable, px, sucre
        ."FROM `la-galette-orceenne`.boissons "
        ."WHERE nom NOT IN (SELECT ingredient FROM crepes2.stocks)"
    );

    $erreur = mysql_select_db("crepes2");

    // COMMANDES ET ITEMS MENU
    $dom_object = new DomDocument();
    $dom_object->load("3AB/commandes.xml");
    $xpath = new Domxpath($dom_object);
    $result = $xpath->query("//Commande");
    foreach ($result as $commande) {
        echo "Commande ";
        // client
        $result2 = $xpath->query("client", $commande);
        $client = $result2->item(0)->nodeValue;
        echo " (".$client.") ";
        envoiRequete ("INSERT INTO `commandes` (`id` , `client` , `date` , `heure` , `livre`) "
                     ."VALUES ('', '$client', '".date('Y-m-d')."', '".date('H:i:s')."', 0)");
        $idCommande = mysql_insert_id();
        echo 'idCommande='.$idCommande."\n";

        // menu
        $result2 = $xpath->query("Menus/Menu", $commande);
        foreach ($result2 as $menu) {
            echo " -- ";
            // nom
            $result3 = $xpath->query("Nom", $menu);
            $nomMenu = $result3->item(0)->nodeValue;
            echo $nomMenu." : ";                         
            envoiRequete ("INSERT INTO menus "
                         ."VALUES ('', '$nomMenu')");    
            $idMenu = mysql_insert_id();
            echo 'idMenu='.$idMenu."\n";
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '$idMenu', 'Menu', 1, 0)");
            // galette
            $result3 = $xpath->query("CrepesSaleesM/CrepeSaleeM", $menu);
            foreach ($result3 as $crepesalee) {
                echo $crepesalee->nodeValue." ";
                envoiRequete ("INSERT INTO itemsmenus "
                             ."VALUES ('$idMenu', '".$crepesalee->nodeValue."', 'Galette', 0)");
            }
            // crepe
            $result3 = $xpath->query("CrepesSucreesM/CrepeSucreeM", $menu);
            foreach ($result3 as $crepesucree) {
                echo $crepesucree->nodeValue." ";       
                envoiRequete ("INSERT INTO itemsmenus "
                             ."VALUES ('$idMenu', '".$crepesucree->nodeValue."', 'Crepe', 0)");
            }
            // boisson
            $result3 = $xpath->query("ItemM/BoissonM", $menu);
            foreach ($result3 as $boisson) {
                echo $boisson->nodeValue." ";             
                envoiRequete ("INSERT INTO itemsmenus "
                             ."VALUES ('$idMenu', '".$boisson->nodeValue."', 'Boisson', 0)");
            }
            // dessert
            $result3 = $xpath->query("ItemM/DessertM", $menu);
            foreach ($result3 as $dessert) {
                echo $dessert->nodeValue." ";                 
                envoiRequete ("INSERT INTO itemsmenus "
                             ."VALUES ('$idMenu', '".$dessert->nodeValue."', 'Dessert', 0)");
            }
        }
        echo "<br/>";
        // galette
        $result2 = $xpath->query("Crepes/CrepesSalees/CrepeSalee", $commande);
        foreach ($result2 as $crepesalee) {
            echo $crepesalee->nodeValue." ";                                                               
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '".$crepesalee->nodeValue."', 'Galette', 1, 0)");
        }
        // crepe
        $result2 = $xpath->query("Crepes/CrepesSucrees/CrepeSucree", $commande);
        foreach ($result2 as $crepesucree) {
            echo $crepesucree->nodeValue." ";                                                              
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '".$crepesucree->nodeValue."', 'Crepe', 1, 0)");
        }
        // boisson
        $result2 = $xpath->query("Item/Boisson", $commande);
        foreach ($result2 as $boisson) {
            echo $boisson->nodeValue." ";     
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '".$boisson->nodeValue."', 'Boisson', 1, 0)");
        }
        // dessert
        $result2 = $xpath->query("Item/Dessert", $commande);
        foreach ($result2 as $dessert) {
            echo $dessert->nodeValue." ";   
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '".$dessert->nodeValue."', 'Dessert', 1, 0)");
        }
        // galette perso
        $result2 = $xpath->query("Crepes/CrepesSalees/CrepePersoSalee", $commande);
        foreach ($result2 as $crepepersosalee) {
            echo "Perso (";                                         
            envoiRequete ("INSERT INTO perso "
                         ."VALUES ('', 0)");
            $idPerso = mysql_insert_id();
            echo "idPerso=$idPerso ";            
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '$idPerso', 'Perso', 1, 0)");
            $result3 = $xpath->query("Ingredient", $crepepersosalee);
            foreach ($result3 as $ingredient) {
                echo $ingredient->nodeValue." ";                     
                envoiRequete ("INSERT INTO perso "
                             ."VALUES ('$idPerso', '".$ingredient->nodeValue."')");
            }
            echo ') ';
        }
        // crepe perso
        $result2 = $xpath->query("Crepes/CrepesSucrees/CrepePersoSucree", $commande);
        foreach ($result2 as $crepepersosucree) {
            echo "Perso (";                                         
            envoiRequete ("INSERT INTO perso "
                         ."VALUES ('', 1)");
            $idPerso = mysql_insert_id();
            echo "idPerso=$idPerso ";            
            envoiRequete ("INSERT INTO itemscommandes "
                         ."VALUES ('$idCommande', '$idPerso', 'Perso', 1, 0)");
            $result3 = $xpath->query("Ingredient", $crepepersosucree);
            foreach ($result3 as $ingredient) {
                echo $ingredient->nodeValue." ";            ;
                envoiRequete ("INSERT INTO ingredientsperso "
                             ."VALUES ('$idPerso', '".$ingredient->nodeValue."')");
            }
            echo ') <br/>';
        }
        echo "<br/>";
        echo "<br/>";
    }
    function lireEtEcrire ($nomFileFrom, $fileTo, $balise) {
        $fileFrom = fopen($nomFileFrom, "r");
        $txt = "";
        while (!feof($fileFrom))
            $txt .= fgets($fileFrom, 4096);
        eregi("<$balise>(.*)</$balise>", $txt, $res);
        fwrite($fileTo, $res[1]);
    }
?>