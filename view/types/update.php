<?php
$type = htmlspecialchars($type);
$pathSelected = htmlspecialchars($path);
$controller = static::$object;
echo "
<h2> Formulaire pour type </h2>
<form method='post' action='index.php?controller=$controller&action=$action'>
	<fieldset>
		<legend>Mon formulaire :</legend>
		<p>
			<label for='type_id'>Nom</label> :
			<input id='type_id' $StateImmatField type='text' placeholder='Ex : Java' value='$type' name='type' required/>
		</p>
		<p>
			<label for='path_id'>Chemin vers l'image associée</label> :
            <select name='path' id='path_id'>";
                foreach ($images as $path) {
                    $path = htmlspecialchars($path);
                    $selected = $path == $pathSelected ? "selected" : "";
                    echo "<option $selected value='$path'>$path</option>";
                }
echo "
            </select>
        </p>
		<p>
			<input type='submit' value='Envoyer' />
		</p>
	</fieldset> 
</form>"
?>