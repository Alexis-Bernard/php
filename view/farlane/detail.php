<h2> Détail du farlane </h2>
<?php
$id = htmlspecialchars($o->getId());
$type = htmlspecialchars($o->getType());
$duree = htmlspecialchars($o->getDuree());
echo "<p> Farlane d'ID $id, de type $type et de durée $duree Heures</p>";
echo "<img src='$path' alt='A wild farlane appear' height='500' width='667'>";
if (isset($_SESSION['mail']) && $_SESSION['admin']) {
    echo "
<form method='get' action='index.php'>
	<input type='hidden' name='action' value='update'/>
	<input type='hidden' name='id' value='$id'/>
	<button type='submit'>Modifier le farlane</button>
</form>";
    echo "
<form method='get' action='index.php'>
	<input type='hidden' name='action' value='delete'/>
	<input type='hidden' name='id' value='$id'/>
	<button type='submit'>Supprimer le farlane</button>
</form>";
}
?>
