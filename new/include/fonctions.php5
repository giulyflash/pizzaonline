
<?php
 
	function selectItem($Liste, $value){
		
		foreach($Liste as $Item){
			$nom = $Item->getElementsByTagName('Nom')->item(0);
			$id = $Item->getAttribute("id");
			if($value===0) $value=1;
			if($id==$value){ echo "<option selected value='" . $nom->nodeValue . "'>" . $nom->nodeValue; $selected =$Item; }
			else echo "<option value='" . $nom->nodeValue . "'>" . $nom->nodeValue; 
		}
		return $selected;
	}
	
	function datefr($date) { 
				$split = split("-",$date); 
				$annee = $split[0]; 
				$mois = $split[1]; 
				$jour = $split[2]; 
				return "$jour"."-"."$mois"."-"."$annee"; 
	}

?>
