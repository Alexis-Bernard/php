<?php
$type = htmlspecialchars($type);
echo "<p> Type $type modifié !</p>";
require File::build_path(array("view","types","list.php"));
?>