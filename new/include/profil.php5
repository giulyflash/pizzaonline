<?php
if($connecte)
{
	db_connect();
	$query='SELECT password, nom, prenom, adresse, codepostal, ville, telephone FROM client WHERE id=\''.$_SESSION['user_id'].'\'';
	$res=db_object_single($query);
	db_close();
	
	echo '<div class="title">Modifier votre profil</div>
<form id="inscription_form" action="index.php5?page=fin_profil" method="post">
    <div class="group">
		Si vous ne souhaitez pas changer de mot de passe, laissez ces champs vides
    	<label for="old_password">Votre ancien mot de passe</label>
        <input type="password" name="old_password" id="old_password" />
        <label for="password">Votre nouveau mot de passe</label>
        <input type="password" name="password" id="password" />
        <label for="password_2">Votre nouveau mot de passe (confirmation)</label>
        <input type="password" name="password_2" id="password_2" />
    </div>
	<label for="nom">Votre nom</label>
	<input type="text" name="nom" id="nom" value="'.$res->nom.'" />
	<label for="prenom">Votre prénom</label>
	<input type="text" name="prenom" id="prenom" value="'.$res->prenom.'" />
	<label for="adresse">Votre adresse</label>
	<input type="text" name="adresse" id="adresse" value="'.$res->adresse.'" />
	<label for="ville">Votre ville</label>
	<input type="text" name="ville" id="ville" value="'.$res->ville.'" />
	<label for="code_postal">Votre code postal</label>
	<input type="text" name="code_postal" id="code_postal" value="'.$res->codepostal.'" />
	<label for="telephone">Votre téléphone</label>
	<input type="text" name="telephone" id="telephone" value="'.$res->telephone.'" />
	<input type="submit" value="Modifier" name="submit" id="submit" />
</form>';
}
else
{
	echo '<div class="title">Erreur</div>
Vous devez être connecté pour modifier votre profil';
}