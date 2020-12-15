<h2> Détail du type </h2>
<?php
$type = htmlspecialchars($o->getType());
$path = htmlspecialchars($o->getPath());
echo "<p> Le type $type à pour image $path</p>";
echo "
<form method='get' action='index.php'>
<input type='hidden' name='controller' value='types'/>
	<input type='hidden' name='action' value='update'/>
	<input type='hidden' name='type' value='$type'/>
	<button type='submit'>Modifier le type</button>
</form>";
echo "
<form method='get' action='index.php'>
<input type='hidden' name='controller' value='types'/>
	<input type='hidden' name='action' value='delete'/>
	<input type='hidden' name='type' value='$type'/>
	<button type='submit'>Supprimer le type</button>
</form>";
?>
