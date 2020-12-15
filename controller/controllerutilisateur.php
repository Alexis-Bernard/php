<?php
require_once File::build_path(array("model","modelutilisateur.php"));
class ControllerUtilisateur {
	protected static $object = "utilisateur";
	private static $sel = "4505213040";

	public static function readall() {
        Error::printErrorIfNotAdmin();
		$view='list';
		$pagetitle='Liste des utilisateurs';
		$tab_o = modelutilisateur::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
        Error::printErrorIfNotAdmin();
		$pagetitle="Détail de l'utilisateur";
		$mail = $_GET["mail"];
		$o = ModelUtilisateur::select($mail);
		if ($o == NULL) Error::printerror("Aucun utilisateur n'a pour mail $mail !");
		$view = 'detail';
		require File::build_path(array("view","view.php"));
	}

	public static function delete() {
        Error::printErrorIfNotAdmin();
		$mail = $_GET['mail'];
		ModelUtilisateur::delete($mail);
		$pagetitle='Résultat';
		$view = 'deleted';
		$tab_o = ModelUtilisateur::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function create() {
        Error::printErrorIfNotAdmin();
		$pagetitle="Création d'un utilisateur";
		$view='update';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : ""; // $_POST est initialisé si le formulaire à rencontré une erreur
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : "";
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $admin = isset($_POST['admin']) ? $_POST['admin'] : "";
        $confirmeKey = isset($_POST['confirmekey']) ? $_POST['confirmekey'] : "";
        $confirmed = isset($_POST['confirmed']) ? $_POST['confirmed'] : "";

		$StateImmatField = "required";
		$action = "created";
		$mdpField = "required";
		require File::build_path(array("view","view.php"));
	}

	public static function update() {
        Error::printErrorIfNotAdmin();
		$pagetitle="Modification d'un utilisateur";
		$view = 'update';
		$o = ModelUtilisateur::select($_GET['mail']);
		$mail = $o->getmail();
        $mdp = $o->getMdp();
		$nom = $o->getNom();
		$prenom = $o->getPrenom();
        $admin = $o->getAdmin();
        $confirmeKey = $o->getConfirmeKey();
        $confirmed = $o->getConfirmed();
		$StateImmatField = "readonly";
		$action = "updated";
        $mdpField = "";
		require File::build_path(array("view","view.php"));
	}

	public static function created() {
        Error::printErrorIfNotAdmin();
        $_POST['admin'] = isset($_POST['admin']);
        $_POST['confirmed'] = isset($_POST['confirmed']);
        $_POST['mdp'] = password_hash($_POST['mdp'] . self::$sel, PASSWORD_DEFAULT);
		$view='created';
		$pagetitle='Résultat';
		if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && ModelUtilisateur::save($_POST)){
            $mail = $_POST["mail"];
            $tab_o = ModelUtilisateur::selectAll();
            require File::build_path(array("view","view.php"));
        }
        else self::create();
	}

	public static function updated() {
        Error::printErrorIfNotAdmin();
	    $_POST['admin'] = isset($_POST['admin']);
        $_POST['confirmed'] = isset($_POST['confirmed']);
        if ($_POST['mdp'] != "") $_POST['mdp'] = password_hash($_POST['mdp'] . self::$sel, PASSWORD_DEFAULT);
        else unset($_POST['mdp']);
		ModelUtilisateur::update($_POST);
		$mail = $_POST['mail'];
		$pagetitle='Résultat';
		$view = 'updated';
		$tab_o = ModelUtilisateur::selectAll();
		require File::build_path(array("view","view.php"));
	}

    public static function connexion() {
        Error::printErrorIfAlreadyConnected();
        $pagetitle='Connexion';
        $view = 'connect';
        require File::build_path(array("view","view.php"));
    }

    public static function connected() {
        Error::printErrorIfAlreadyConnected();
        $o = ModelUtilisateur::select($_POST['mail']);
        if ($o == NULL) {
            Error::printerror("L'email {$_POST['mail']} n'est associé à aucun compte !");
        }
        else if (!password_verify($_POST['mdp'] . self::$sel, $o->getMdp())){
            Error::printerror("Mauvais mot de passe !");
        }
        else{
            $_SESSION['mail'] = $_POST['mail'];
            header("Refresh: 0;url=index.php");
        }
    }

    public static function disconnect() {
        Error::printErrorIfNotConnected();
        session_unset();
        session_destroy();
        header("Refresh: 0;url=index.php");
    }
}
?>