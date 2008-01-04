<?php
	if($auth_error)
	{
		echo '<div class="title">Erreur a la connexion</div>
		Une erreur s\'est produite au moment de la connexion, verifiez votre nom d\'utilisateur et votre mot de passe.';
	}
	else
	{
		echo '<div class="title">Connexion reussie</div>
		Vous etes maintenant connectes.
		Vous pouvez faire votre commande ou modifier votre profil.';
	}
?>