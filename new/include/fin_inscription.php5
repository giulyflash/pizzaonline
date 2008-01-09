<?php
	if(empty($_POST['login']) || empty($_POST['password']) || empty($_POST['password_2']) || empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['ville']) || empty($_POST['code_postal']) || empty($_POST['telephone']))
	{
		echo '<h1>Erreur</h1>Tous les champs n\'ont pas été remplis correctement.';
		echo '<br /><a href="index.php5?page=inscription">Retour au formulaire d\'inscription/a>';
	}
	else
	{
		if($_POST['password']!=$_POST['password_2'])
		{
			echo '<h1>Erreur</h1>Les mots de passe ne sont pas cohérents.';
			echo '<br /><a href="index.php5?page=inscription">Retour au formulaire</a>';
		}
		else
		{
			db_connect();
			// recherche si l'utilisateur n'existe pas
			if(db_object_single('SELECT count(*) AS nb FROM client WHERE login=\''.mysql_real_escape_string($_POST['login']).'\'')->nb!=0)
			{
				echo '<h1>Erreur</h1>Un utilisateur portant le même nom d\'utilisateur existe déjà, veuillez en choisir un nouveau.';
				echo '<br /><a href="index.php5?page=inscription">Retour au formulaire</a>';
			}
			else
			{
				$query='INSERT INTO client(login, password, nom, prenom, adresse, codepostal, ville, telephone) VALUES (\''.mysql_real_escape_string($_POST['login']).'\', \''.mysql_real_escape_string($_POST['password']).'\', \''.mysql_real_escape_string($_POST['nom']).'\', \''.mysql_real_escape_string($_POST['prenom']).'\', \''.mysql_real_escape_string($_POST['adresse']).'\', \''.mysql_real_escape_string($_POST['ville']).'\', \''.mysql_real_escape_string($_POST['code_postal']).'\', \''.mysql_real_escape_string($_POST['telephone']).'\')';
				//echo $query;
				if(db_query($query))
				{
					echo '<h1>Inscription terminée</h1>Vous pouvez à present vous identifier avec le nom d\'utilisateur et le mot de passe que vous avez indiqués.';
				}
				else
				{
					echo '<h1>Erreur</h1>Erreur de connexion à la base de données.';
					echo '<br /><a href="index.php5?page=inscription">Retour au formulaire</a>';
				}
				
			}
			db_close();
		}
	}
?>