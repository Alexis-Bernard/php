<h2> Liste des farlane </h2>
<?php
foreach ($tab_o as $o){
	$idUrl = rawurlencode($o->getId());
	$idHTML = htmlspecialchars($o->getId());
	echo "
	<p>
		Farlane d'ID
		<a href='index.php?action=read&id=$idUrl'>
			$idHTML
		</a>
	</p>";
}
if (isset($_SESSION['mail']) && $_SESSION['admin']) echo "
<form method='get' action='index.php'>
	<input type='hidden' name='action' value='create'/>
	<button type='submit'>Ajouter un farlane</button>
</form>";
?>