<?php
$type = htmlspecialchars($type);
echo "<p> Type $type supprimé !</p>";
require File::build_path(array("view","types","list.php"));
?>