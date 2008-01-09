<?php
	if($auth_error)
	{
		echo '<h1>Erreur à la connexion</h1>
		Une erreur s\'est produite au moment de la connexion, verifiez votre nom d\'utilisateur et votre mot de passe.';
	}
	else
	{
		echo '<h1>Connexion réussie</h1>
		Vous êtes maintenant connecté.
		Vous pouvez faire votre commande ou modifier votre profil.';
	}
?>