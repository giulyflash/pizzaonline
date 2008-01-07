<?php

	// affiche les erreurs
	function shErreur($msg,$ch=1)
	{
		if($ch == 1)	echo ("Erreur: ".$msg."<br>");
		else if ($ch == 2) echo ("Erreur: ".$msg." - mysql:".mysql_error()."<br>");
		else if ($ch == 0) die ("Erreur: ".$msg);
	}
	
	function shMessage($msg,$ch=1)
	{
		if($ch == 1)	echo ("Message: ".$msg."<br>");
		else if ($ch == 0) die ("Message: ".$msg);
	}
	
	function affDB($res,$msg)
	{
		if($res < 0) {
		   if($res == -1) $msg = "Connexion au serveur impossible !";
		   elseif($res == -2) $msg = "Connexion à la bdd impossible !";
		   elseif($res == -3) $msg = "Fichier de configuration introuvable";
		   else $msg = "Requête $sql invalide !";
		   shErreur($msg,2);
		}
		else
		{
			shMessage($msg);
		}
		
	}
	
	function queryDB($sql, $type='select', $prefixe='') 
	{
		include('param.php5');
		//recherche des informations de configuration
		$result = -8;
		//$dom = new DomDocument();
		//$fileName = $prefixe."configuration.xml";
		//if(!file_exists($fileName) || !$dom->Load($fileName))
//		{
//			return -3; // fichier de base inéxistant
//		}
//		else
//		{
			//$dom->validateOnParse = true;
			//$config = $dom->getElementsByTagName('connexionBD')->item(0);
			
			$host = $db_host;//$config->getAttribute("host");
			$user = $db_login;//$config->getAttribute("login");
			$password = $db_pass;//$config->getAttribute("password");
			$bdName = $db_name;//$config->getAttribute("bdName");
			
		   if (!$db = @mysql_connect($host,$user,$password))
		   {
		      	return -1;
		   }

		   if (!@mysql_select_db($bdName, $db)) {
		      @mysql_close($db);
		      return -2;
		   }
		   switch($type) {
		   	  /*INSERT
				$sql = "INSERT INTO $ma_table (id,titre) VALUES ('','Glop')";
				$res = queryDB($sql,1);
				$id = $res;*/
		      case 'insert' :
		      	@mysql_query($sql,$db);
		      	$result = @mysql_insert_id(); break; // recupére le derniére id généré automatiquement
		      /*UPDATE
				$sql = "UPDATE $ma_table SET titre = 'PasGlop' WHERE id='$id'";
				$res = queryDB($sql,2);*/
		      case 'update' :
		      	@mysql_query($sql,$db);
		      	$result = @mysql_affected_rows(); break;
		      	/*DELETE
				$sql = "DELETE FROM $ma_table WHERE id='$id'";
				$res = queryDB($sql,2);*/
		      case 'delete' :
		      	@mysql_query($sql,$db);
		      	echo @mysql_affected_rows();
		      	$result = @mysql_affected_rows(); break;
		      /*REQUETE
		        $sql = "SELECT * FROM 'statutsenseignant'";
           		$result = queryDB($sql);
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				    echo "<option value=".$row[""].">".$row[""]."</option> <br>";
				}
				mysql_free_result($result);	*/
		      case 'select' : $result = @mysql_query($sql,$db); break;
		   }
		   @mysql_close($db);
		//}
		return $result;   
	}
	
	function codeMP($login,$password)
	{	
		$code = $password;
		return $code;
	}
?>