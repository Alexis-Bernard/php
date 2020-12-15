<?php
require_once File::build_path(array("controller","controllerfarlane.php"));
require_once File::build_path(array("controller","controllerutilisateur.php"));
require_once File::build_path(array("controller","controllertypes.php"));

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30))) { // 30 Secondes
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
else if (isset($_SESSION['mail'])){
    $_SESSION['LAST_ACTIVITY'] = time();
    $_SESSION['user'] = ModelUtilisateur::select($_SESSION['mail']);
    if ($_SESSION['user'] == false) ControllerUtilisateur::disconnect();
    else {
        $_SESSION['nom'] = $_SESSION['user']->getNom();
        $_SESSION['prenom'] = $_SESSION['user']->getPrenom();
        $_SESSION['confirmed'] = $_SESSION['user']->getConfirmed();
        $_SESSION['admin'] = $_SESSION['user']->getAdmin();
    }
}

if (!isset($_GET['action'])) $_GET['action'] = "readall";
$_GET['controller'] = 'Controller' . ucfirst(isset($_GET['controller']) ? $_GET["controller"] : 'Farlane');

if (class_exists($_GET['controller']) && in_array($_GET["action"], get_class_methods($_GET['controller'])))
	$_GET['controller']::{$_GET["action"]}();
else erreur::printerror("Le nom de la classe ou de la méthode n'existe pas. '{$_GET['controller']}::{$_GET['action']}()'");
?>