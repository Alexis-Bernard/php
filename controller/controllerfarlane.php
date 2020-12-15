<?php
require_once File::build_path(array("model","modelfarlane.php"));
class Controllerfarlane {
	protected static $object = "farlane";

	public static function readall() {
		$view='list';
		$pagetitle='Liste des farlane';
		$tab_o = Modelfarlane::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$pagetitle='Détail du farlane';
		$id = $_GET["id"];
		$o = Modelfarlane::select($id);
		$path = Modelfarlane::getPath($id);
		if ($o== NULL) Error::printerror("Aucun farlane n'a l'id $id !");
		$view = 'detail';
		require File::build_path(array("view","view.php"));
	}

	public static function delete() {
	    Error::printErrorIfNotAdmin();
	    $id = $_GET['id'];
		Modelfarlane::delete($id);
		$pagetitle='Résultat';
		$view = 'deleted';
		$tab_o = Modelfarlane::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function create() {
        Error::printErrorIfNotAdmin();
		$pagetitle="Création d'un farlane";
		$view='update';
        $id = isset($_POST['id']) ? $_POST['id'] : ""; // $_POST est initialisé si le formulaire à rencontré une erreur
        $type = isset($_POST['type']) ? $_POST['type'] : "";
        $duree = isset($_POST['duree']) ? $_POST['duree'] : "";
        $tab_o = Modeltypes::selectAll();
		$StateImmatField = "required";
		$action = "created";
		require File::build_path(array("view","view.php"));
	}

	public static function update() {
        Error::printErrorIfNotAdmin();
		$pagetitle='Modification du farlane';
		$view = 'update';
		$o = Modelfarlane::select($_GET['id']);
		$id = $o->getId();
		$type = $o->getType();
		$duree = $o->getDuree();
        $tab_o = Modeltypes::selectAll();
		$StateImmatField = "readonly";
		$action = "updated";
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
        Error::printErrorIfNotAdmin();
		$view='created';
		$pagetitle='Résultat';
		if (Modelfarlane::save($_POST)){
            $id = $_POST["id"];
            $tab_o = Modelfarlane::selectAll();
            require File::build_path(array("view", "view.php"));
        }
		else self::create();
	}
	
	public static function updated() {
        Error::printErrorIfNotAdmin();
		Modelfarlane::update($_POST);
		$id = $_POST['id'];
		$pagetitle='Résultat';
		$view = 'updated';
		$tab_o = Modelfarlane::selectAll();
		require File::build_path(array("view","view.php"));
	}
}
?>