<h2> Liste des utilisateurs </h2>
<?php
foreach ($tab_o as $o){
	$mail_URL = rawurlencode($o->getMail());
	$mail_HTML = htmlspecialchars($o->getMail());
	$admin = $o->getAdmin() ? " (Admin)" : "";
    $confirmed = !$o->getConfirmed() ? " (Non confirmé)" : "";
	echo "
    <p>
        Mail :
        <a href='index.php?controller=utilisateur&action=read&mail=$mail_URL'>
            $mail_HTML
        </a>
        $admin $confirmed
    </p>";
}
echo "<form method='get' action='index.php'>
<input type='hidden' name='controller' value='utilisateur'/>
<input type='hidden' name='action' value='create'/>
<button type='submit'>Ajouter un utilisateur</button>
</form>";
?>