<?php
$id = htmlspecialchars($id);
echo "<p> farlane d'ID $id supprimé !</p>";
require File::build_path(array("view","farlane","list.php"));
?>