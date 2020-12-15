<?php
$id = htmlspecialchars($id);
$typeSelected = htmlspecialchars($type);
$duree = htmlspecialchars($duree);
$controller = static::$object;
echo "
<h2> Formulaire pour farlane </h2>
<form method='post' action='index.php?controller=$controller&action=$action'>
	<fieldset>
		<legend>Mon formulaire :</legend>
		<p>
			<label for='id_id'>ID</label> :
			<input id='id_id' $StateImmatField type='number' min='0' max='4294967295' placeholder='Ex : 123' value='$id' name='id' required/>
		</p>
		<p>
			<label for='type_id'>Type</label> :
                <select name='type' id='type_id'>";
                    foreach ($tab_o as $o){
                        $type = htmlspecialchars($o->getType());
                        $selected = $type == $typeSelected ? "selected" : "";
                        echo "<option $selected value='$type'>$type</option>";
                    }
echo "
                </select>
		</p>
		<p>
			<label for='duree_id'>Durée en heures</label> :
			<input id='duree_id' type='number' placeholder='Ex : 10' value='$duree' name='duree' required/>
		</p>
		<p>
			<input type='submit' value='Envoyer' />
		</p>
	</fieldset> 
</form>"
?>