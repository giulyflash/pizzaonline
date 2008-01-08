
<?php
 
	function selectItem($Liste, $value){
		
		foreach($Liste as $Item){
			$nom = $Item->getElementsByTagName('Nom')->item(0);
			$id = $Item->getAttribute("id");
			if($value===0) $value=1;
			if($id==$value) echo "<option selected value='" . $id . "'>" . $nom->nodeValue;
			else echo "<option value='" . $id . "'>" . $nom->nodeValue; 
		}
		return $value;
	}

?>
