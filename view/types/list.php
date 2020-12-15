<h2> Liste des types </h2>
<?php
foreach ($tab_o as $o){
	$type_Url = rawurlencode($o->getType());
	$type_HTML = htmlspecialchars($o->getType());
	echo "
	<p>
		<a href='index.php?controller=types&action=read&type=$type_Url'>
			$type_HTML
		</a>
	</p>";
}
echo "
<form method='get' action='index.php'>
	<input type='hidden' name='controller' value='types'/>
	<input type='hidden' name='action' value='create'/>
	<button type='submit'>Ajouter un type</button>
</form>";
?>