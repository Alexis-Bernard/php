<?php
echo "
<h2> Formulaire de connexion </h2>
<form method='post' action='index.php?controller=utilisateur&action=connected'>
	<fieldset>
		<legend>Connexion :</legend>
		<p>
			<label for='mail_id'>Mail</label> :
			<input id='mail_id' type='email' name='mail' required/>
		</p>
		<p>
			<label for='mdp_id'>Mot de passe</label> :
			<input id='mdp_id' type='text' name='mdp' required/>
		</p>
		<p>
			<input type='submit' value='Envoyer' />
		</p>
	</fieldset>
</form>"
?>