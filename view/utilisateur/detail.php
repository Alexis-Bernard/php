<h2> Détail de l'utilisateur </h2>
<?php
$nom = htmlspecialchars($o->getNom());
$prenom = htmlspecialchars($o->getPrenom());
$mail = htmlspecialchars($o->getMail());
$mdp = htmlspecialchars($o->getMdp());
$admin = $o->getAdmin() ? "Oui" : "Non";
$confirmed = $o->getConfirmed() ? "Oui" : "Non";
echo "<p> Mail : $mail";
echo "<p> Mot de passe : $mdp";
echo "<p> Nom/Prénom : $nom $prenom</p>";
echo "<p> Admin : $admin</p>";
echo "<p> Confirmé : $confirmed</p>";
echo "<form method='get' action='index.php'>
<input type='hidden' name='controller' value='utilisateur'/>
<input type='hidden' name='action' value='update'/>
<input type='hidden' name='mail' value='$mail'/>
<button type='submit'>Modifier l'utilisateur</button>
</form>";
echo "<form method='get' action='index.php'>
<input type='hidden' name='controller' value='utilisateur'/>
<input type='hidden' name='action' value='delete'/>
<input type='hidden' name='mail' value='$mail'/>
<button type='submit'>Supprimer l'utilisateur</button>
</form>";
?>
