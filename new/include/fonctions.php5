
<?php
 
	function selectItem($Liste, $value){
		$first = $Liste->item(0)->getElementsByTagName('Nom')->item(0);
		foreach($Liste as $Item){
			$nom = $Item->getElementsByTagName('Nom')->item(0);
			if($value=="0") $value=$first;
			if($nom==$value){ echo "<option selected value='" . $nom->nodeValue . "'>" . $nom->nodeValue;  }
			else echo "<option value='" . $nom->nodeValue . "'>" . $nom->nodeValue; 
		}
	}
	
	function datefr($date) { 
				$split = split("-",$date); 
				$annee = $split[0]; 
				$mois = $split[1]; 
				$jour = $split[2]; 
				return "$jour"."-"."$mois"."-"."$annee"; 
	}

?>
