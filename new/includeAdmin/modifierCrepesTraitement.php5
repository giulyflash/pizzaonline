	<?php
        $dom = new DomDocument();
        $dom->load('xml/nourriture.xml');
		$xpath = new Domxpath($dom);
        
        if(empty($_POST['ingredient']))
        {
            echo '<div class="title">Erreur</div>Aucun ingredient séléctionné.';
        }
        else if(empty($_POST['prix']))
        {
            echo '<div class="title">Erreur</div>Aucun prix indiqué.';
        }
        else
        {
            $racine = $dom->documentElement;
            $id = $dom->getElementsByTagName($_POST['type'])->length + 1;
			if(!empty($_POST['nom']))
			{
				 $nom = $_POST['nom'];
			}
			else
			{
				$nom="";
				foreach ($_POST['ingredient'] as $ingredient)
				{
					$nom=$nom.$ingredient." ";
				}
			}
			$type = $_POST['type'];
			$result = $xpath->query("//$type [Nom='$nom']");
			
			if ($result->length == 0) 
			{
				$type_xml = $dom->createElement($_POST['type']);
				$type_xml->setAttribute("id",$id);
				
				$nom_xml = $dom->createElement("Nom");
				$nom_xml_text = $dom->createTextNode($nom);
				$nom_xml->appendChild ($nom_xml_text);
				$type_xml->appendChild ($nom_xml);
				
				$prix_xml = $dom->createElement("Prix");
				$prix_xml_text = $dom->createTextNode($_POST['prix']);
				$prix_xml->appendChild ($prix_xml_text);
				$type_xml->appendChild ($prix_xml);
				
				$ingredients_xml = $dom->createElement("Ingredients");
		
				foreach ($_POST['ingredient'] as $ingredient)
				{
					$ingredient_xml = $dom->createElement("Ingredient");
					$ingredient_xml_text = $dom->createTextNode($ingredient);
					$ingredient_xml->appendChild ($ingredient_xml_text);
					$ingredients_xml->appendChild ($ingredient_xml);
				}
				$type_xml->appendChild ($ingredients_xml);
				$racine->appendChild ($type_xml);
				echo ($_POST['type']." ".$nom." ajoutée au fichier avec un prix de ".$_POST['prix']."€");
				$dom->save('xml/nourriture.xml');
			}
			else
			{
				echo '<div class="title">Erreur</div>'.$_POST['type']." ".$nom." déja présente dans la base ";
			}
		}	
        header('location:indexAdmin.php5?page=modifierSupprimerCrepes');
    ?>

