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
			if(db_object_single('SELECT count(*) AS nb FROM client WHERE login=\''.mysql_real_escape_string($_POST['login']).'\'')->nb!=0)
			{
				echo '<div class="title">Erreur</div>Un utilisateur portant le meme nom existe deja, veuillez en choisir un nouveau.';
			}
			else
			{
				$query='INSERT INTO client(login, password, nom, prenom, adresse, codepostal, ville, telephone) VALUES (\''.mysql_real_escape_string($_POST['login']).'\', \''.mysql_real_escape_string($_POST['password']).'\', \''.mysql_real_escape_string($_POST['nom']).'\', \''.mysql_real_escape_string($_POST['prenom']).'\', \''.mysql_real_escape_string($_POST['adresse']).'\', \''.mysql_real_escape_string($_POST['ville']).'\', \''.mysql_real_escape_string($_POST['code_postal']).'\', \''.mysql_real_escape_string($_POST['telephone']).'\')';
				echo $query;
				if(db_query($query))
				{
					echo '<div class="title">Inscription terminee</div>Vous pouvez a present vous identifier avec le nom d\'utilisateur et le mot de passe que vous avez indiques.';
				}
				else
				{
					echo '<div class="title">Erreur</div>Erreur de connexion a la base de données.';
				}
				
			}
		}
		db_close();
	}
?>