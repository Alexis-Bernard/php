<?php
$mail = htmlspecialchars($mail);
$mdp = htmlspecialchars($mdp);
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
echo "
<h2> Formulaire pour compte </h2>
<form method='post' action='index.php?controller=utilisateur&action=inscripted'>
	<fieldset>
		<legend>Okayyy let's goo pour créer un compte :</legend>
		<p>
			<label for='mail_id'>Mail</label> :
			<input id='mail_id' type='email' placeholder='Ex : toto@gmail.com' value='$mail' name='mail' required/>
		</p>
		<p>
			<label for='mdp_id'>Mot de passe</label> :
			<input id='mdp_id' type='text' placeholder='Ex : superMDP' value='' name='mdp' required/>
		</p>
		<p>
			<label for='nom_id'>Nom</label> :
			<input id='nom_id' type='text' placeholder='Ex : Wej' value='$nom' name='nom' required/>
		</p>
		<p>
			<label for='prenom_id'>Prenom</label> :
			<input id='prenom_id' type='text' placeholder='Ex : Den' value='$prenom' name='prenom' required/>
		</p>
		<p>
			<input type='submit' value='Envoyer' />
		</p>
	</fieldset>
</form>"
?>