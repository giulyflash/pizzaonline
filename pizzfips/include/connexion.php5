<?php
	if($auth_error)
	{
		echo '<div class="title">Erreur � la connexion</div>
		Une erreur s\'est produite au moment de la connexion, verifiez votre nom d\'utilisateur et votre mot de passe.';
	}
	else
	{
		echo '<div class="title">Connexion r�ussie</div>
		Vous �tes maintenant connect�s.
		Vous pouvez faire votre commande ou modifier votre profil.';
	}
?>