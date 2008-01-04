<?php
	function db_connect()
	{
		global $db_host;
		global $db_login;
		global $db_pass;
		global $db_name;
		$db=mysql_connect($db_host,$db_login,$db_pass) or die(mysql_error());
		mysql_select_db($db_name, $db) or die(mysql_error());
	}
	
	function db_select_connect($db_n)
	{
		global $db_host;
		global $db_login;
		global $db_pass;
		$db=mysql_connect($db_host,$db_login,$db_pass) or die(mysql_error());
		mysql_select_db($db_n, $db) or die(mysql_error());
	}
	
	function db_query($query)
	{
		return (mysql_query($query));
	}
	
	function db_object_single($query)
	{
		$result=db_query($query);
		if(!$result)
		{
			return(false);
		}
		else
		{
			return(mysql_fetch_object($result));
		}
	}
	
	function db_object_array($query)
	{
		$i=0;
		if($r=db_query($query))
		{
			$array=array();
			while ($tab=mysql_fetch_object($r))
			{
				$array[$i]=$tab;
				$i++;
			}
			return($array);
		}
		else
		{
			return(false);
		}
	}
	
	function db_last_id()
	{
		return(mysql_insert_id());
	}
	
	function db_close()
	{
		mysql_close();
	}
?>