<?php
$mail = htmlspecialchars($mail);
$mdp = htmlspecialchars($mdp);
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$admin = $admin ? "checked" : "";
$confirmed = $confirmed ? "checked" : "";
$controller = static::$object;
echo "
<h2> Formulaire pour utilisateur </h2>
<form method='post' action='index.php?controller=$controller&action=$action'>
	<fieldset>
		<legend>Mon formulaire :</legend>
		<p>
			<label for='mail_id'>Mail</label> :
			<input id='mail_id' $StateImmatField type='email' placeholder='Ex : toto@gmail.com' value='$mail' name='mail' required/>
		</p>
		<p>
			<label for='mdp_id'>Mot de passe</label> :
			<input id='mdp_id' type='text' placeholder='Ex : superMDP' value='' name='mdp' $mdpField/>
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
			<label for='admin_id'>Admin</label> :
			<input id='admin_id' type='checkbox' $admin name='admin'/>
		</p>
		<p>
			<label for='confirmed_id'>Confirmé</label> :
			<input id='confirmed_id' type='checkbox' $confirmed name='confirmed'/>
		</p>
		<p>
			<input type='submit' value='Envoyer' />
		</p>
	</fieldset>
</form>"
?>