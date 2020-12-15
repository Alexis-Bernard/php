<?php
require_once File::build_path(array("model","modelcommande.php"));
class ControllerCommande {
    protected static $object = "commande";

    public static function readall() {
        $view = 'list';
        $pagetitle = 'Liste des commandes';
        $tab_o = Modelcommande::selectAll();
        require File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $pagetitle='Détail du type';
        $type = $_GET["type"];
        $o = Modelcommande::select($type);
        if ($o == NULL) Error::printerror("le type $type n'existe pas !");
        $view = 'detail';
        require File::build_path(array("view","view.php"));
    }

    public static function delete() {
        $type = $_GET['type'];
        $pagetitle='Résultat';
        if (!Modelcommande::delete($type))
            Error::printerror("Le type $type n'a pas été supprimé, une erreur est survenue");
        $view = 'deleted';
        $tab_o = Modelcommande::selectAll();
        require File::build_path(array("view","view.php"));
    }

    public static function create() {
        $pagetitle="Création d'une commande";
        $view='update';
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        $type = isset($_POST['type']) ? $_POST['type'] : ""; // $_POST est initialisé si le formulaire à rencontré une erreur
        $path = isset($_POST['path']) ? $_POST['path'] : "";
        $StateImmatField = "required";
        $action = "created";
        require File::build_path(array("view","view.php"));
    }

    public static function update() {
        $pagetitle='Modification du type';
        $view = 'update';
        $o = Modelcommande::select($_GET['type']);
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
        Error::printErrorIfNotAdmin();
        $view='created';
        $pagetitle='Résultat';
        if (Modelcommande::save($_POST)){
            $type = $_POST["type"];
            $tab_o = Modelcommande::selectAll();
            require File::build_path(array("view","view.php"));
        }
        else self::create();
    }

    public static function updated() {
        Error::printErrorIfNotAdmin();
        Modelcommande::update($_POST);
        $type = $_POST['type'];
        $pagetitle='Résultat';
        $view = 'updated';
        $tab_o = Modelcommande::selectAll();
        require File::build_path(array("view","view.php"));
    }
}
?>