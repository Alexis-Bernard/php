<?php
require_once File::build_path(array("model","modeltypes.php"));
class ControllerTypes {
	protected static $object = "types";

	public static function readall() {
        erreur::printErrorIfNotAdmin();
        $view = 'list';
        $pagetitle = 'Liste des types';
        $tab_o = Modeltypes::selectAll();
        require File::build_path(array("view", "view.php"));
	}

	public static function read() {
        erreur::printErrorIfNotAdmin();
		$pagetitle='Détail du type';
		$type = $_GET["type"];
		$o = Modeltypes::select($type);
        if ($o == NULL) Error::printerror("le type $type n'existe pas !");
		$view = 'detail';
		require File::build_path(array("view","view.php"));
	}

	public static function delete() {
        erreur::printErrorIfNotAdmin();
	    $type = $_GET['type'];
        $pagetitle='Résultat';
		if (!Modeltypes::delete($type))
            erreur::printerror("Le type $type n'a pas été supprimé, une erreur est survenue");
        $view = 'deleted';
        $tab_o = Modeltypes::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function create() {
        erreur::printErrorIfNotAdmin();
		$pagetitle="Création d'un farlane";
		$view='update';
        $type = isset($_POST['type']) ? $_POST['type'] : ""; // $_POST est initialisé si le formulaire à rencontré une erreur
        $path = isset($_POST['path']) ? $_POST['path'] : "";
		$StateImmatField = "required";
		$action = "created";
		$images = scandir(File::build_path(array("img")));
		unset($images[0]);
        unset($images[1]);
		require File::build_path(array("view","view.php"));
	}

	public static function update() {
        erreur::printErrorIfNotAdmin();
		$pagetitle='Modification du type';
		$view = 'update';
		$o = Modeltypes::select($_GET['type']);
		$type = $o->getType();
		$path = $o->getPath();
		$StateImmatField = "readonly";
		$action = "updated";
        $images = scandir(File::build_path(array("img")));
        unset($images[0]);
        unset($images[1]);
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
        erreur::printErrorIfNotAdmin();
		$view='created';
		$pagetitle='Résultat';
        if (Modeltypes::save($_POST)){
            $type = $_POST["type"];
            $tab_o = Modeltypes::selectAll();
            require File::build_path(array("view","view.php"));
        }
        else self::create();
	}

	public static function updated() {
        erreur::printErrorIfNotAdmin();
		Modeltypes::update($_POST);
		$type = $_POST['type'];
		$pagetitle='Résultat';
		$view = 'updated';
		$tab_o = Modeltypes::selectAll();
		require File::build_path(array("view","view.php"));
	}
}
?>