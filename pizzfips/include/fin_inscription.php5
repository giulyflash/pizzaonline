<?php
	if(!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['password_2']) || !isset($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['ville']) || empty($_POST['code_postal']) || empty($_POST['telephone']))
	{
		echo '<div class="title">Erreur</div>Tous les champs n\'ont pas ete remplis correctement.';
	}
	else
	{
		if($_POST['password']!=$_POST['password_2'])
		{
			echo '<div class="title">Erreur</div>Les mots de passe ne sont pas coherents.';
		}
		else
		{
			db_connect();
			// recherche si l'utilisateur n'existe pas
			if(db_object_single('SELECT count(*) AS nb FROM user WHERE user_login=\''.mysql_real_escape_string($_POST['subscribe_login']).'\'')->nb==0)
			{
				if(db_query('INSERT INTO user(user_login, user_password, user_email) VALUES (\''.mysql_real_escape_string($_POST['subscribe_login']).'\', \''.mysql_real_escape_string($_POST['subscribe_password']).'\', \''.mysql_real_escape_string($_POST['subscribe_email']).'\')'))
				{
					echo '<status>0</status>';
				}
				else
				{
					echo '<status>-1</status>';
				}
				
			}
		}
		else
		{
			echo '<status>-1</status>';
		}
		db_close();