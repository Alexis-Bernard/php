<?php
$mail = htmlspecialchars($mail);
echo "<p> Utilisateur de mail $mail modifié !</p>";
require File::build_path(array("view","utilisateur","list.php"));
?>