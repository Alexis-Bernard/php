<?php
$id = htmlspecialchars($id);
echo "<p> Farlane d'ID $id modifié !</p>";
require File::build_path(array("view","Farlane","list.php"));
?>