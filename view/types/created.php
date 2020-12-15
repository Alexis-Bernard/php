<?php
$type = htmlspecialchars($type);
echo "<p> type $type créé !</p>";
require File::build_path(array("view","types","list.php"));
?>