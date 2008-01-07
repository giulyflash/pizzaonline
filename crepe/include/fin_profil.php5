<?php
	if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['adresse']) || empty($_POST['ville']) || empty($_POST['code_postal']) || empty($_POST['telephone']))
	{
		echo '<div class="title">Erreur</div>Tous les champs n\'ont pas ete remplis correctement.';
	}
	else
	{
		if(!empty($_POST['old_password']))
		{
			if(empty($_POST['password']) || empty($_POST['password_2']) || $_POST['password']!=$_POST['password_2'])
			{
				echo '<div class="title">Erreur</div>Les nouveaux mots de passe ne sont pas coherents.';
			}
			else
			{
				db_connect();
				// on verifie qu'il s'agit bien de l'ancien mot de passe
				if(db_object_single('SELECT count(*) AS nb FROM client WHERE id=\''.$_SESSION['user_id'].'\' AND password=\''.$_POST['old_password'].'\'')->nb==0)
				{
					echo '<div class="title">Erreur</div>Le mot de passe entre ne correspond pas a celui du compte.';
				}
				else
				{
					$query='UPDATE client SET password=\''.mysql_real_escape_string($_POST['password']).'\', nom=\''.mysql_real_escape_string($_POST['nom']).'\', prenom=\''.mysql_real_escape_string($_POST['prenom']).'\', adresse=\''.mysql_real_escape_string($_POST['adresse']).'\', ville=\''.mysql_real_escape_string($_POST['ville']).'\', codepostal=\''.mysql_real_escape_string($_POST['code_postal']).'\', telephone=\''.mysql_real_escape_string($_POST['telephone']).'\' WHERE id=\''.$_SESSION['user_id'].'\'';
					if(db_query($query))
					{
						echo '<div class="title">Modifications effectues</div>Les nouvelles informations entrees ont bien ete enregistrees.';
					}
					else
					{
						echo '<div class="title">Erreur</div>Erreur de connexion a la base de données.';
					}
					
				}
				db_close();
			}
		}
		else
		{
			db_connect();
			$query='UPDATE client SET nom=\''.mysql_real_escape_string($_POST['nom']).'\', prenom=\''.mysql_real_escape_string($_POST['prenom']).'\', adresse=\''.mysql_real_escape_string($_POST['adresse']).'\', ville=\''.mysql_real_escape_string($_POST['ville']).'\', codepostal=\''.mysql_real_escape_string($_POST['code_postal']).'\', telephone=\''.mysql_real_escape_string($_POST['telephone']).'\' WHERE id=\''.$_SESSION['user_id'].'\'';
			if(db_query($query))
			{
				echo '<div class="title">Modifications effectues</div>Les nouvelles informations entrees ont bien ete enregistrees.';
			}
			else
			{
				echo '<div class="title">Erreur</div>Erreur de connexion a la base de données.';
			}
			db_close();
		}
	}
?>