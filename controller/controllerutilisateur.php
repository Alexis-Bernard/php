<?php
require_once File::build_path(array("model","modelutilisateur.php"));
class ControllerUtilisateur {
	protected static $object = "utilisateur";
	private static $sel = "4505213040";

	public static function readall() {
        erreur::printErrorIfNotAdmin();
		$view='list';
		$pagetitle='Liste des utilisateurs';
		$tab_o = modelutilisateur::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
        erreur::printErrorIfNotAdmin();
		$pagetitle="Détail de l'utilisateur";
		$mail = $_GET["mail"];
		$o = ModelUtilisateur::select($mail);
		if ($o == NULL) erreur::printerror("Aucun utilisateur n'a pour mail $mail !");
		$view = 'detail';
		require File::build_path(array("view","view.php"));
	}

	public static function delete() {
        erreur::printErrorIfNotAdmin();
		$mail = $_GET['mail'];
		ModelUtilisateur::delete($mail);
		$pagetitle='Résultat';
		$view = 'deleted';
		$tab_o = ModelUtilisateur::selectAll();
		require File::build_path(array("view","view.php"));
	}

	public static function create() {
        erreur::printErrorIfNotAdmin();
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
        erreur::printErrorIfNotAdmin();
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
        erreur::printErrorIfNotAdmin();
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
        erreur::printErrorIfNotAdmin();
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
        erreur::printErrorIfAlreadyConnected();
        $pagetitle='Connexion';
        $view = 'connect';
        require File::build_path(array("view","view.php"));
    }

    public static function connected() {
        erreur::printErrorIfAlreadyConnected();
        $o = ModelUtilisateur::select($_POST['mail']);
        if ($o == NULL) {
            erreur::printerror("L'email {$_POST['mail']} n'est associé à aucun compte !");
        }
        else if (!password_verify($_POST['mdp'] . self::$sel, $o->getMdp())){
            erreur::printerror("Mauvais mot de passe !");
        }
        else{
            $_SESSION['mail'] = $_POST['mail'];
            header("Refresh: 0;url=index.php");
        }
    }

    public static function disconnect() {
        erreur::printErrorIfNotConnected();
        session_unset();
        session_destroy();
        header("Refresh: 0;url=index.php");
    }

    public static function inscription() {
        erreur::printErrorIfAlreadyConnected();

        $pagetitle="Inscription";
        $view='inscription';
        $mail = isset($_POST['mail']) ? $_POST['mail'] : ""; // $_POST est initialisé si le formulaire à rencontré une erreur
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : "";
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";

        require File::build_path(array("view","view.php"));
    }

    public static function inscripted() {
        erreur::printErrorIfAlreadyConnected();
        $confirmekey = GenerateKey::generate();
        $_POST['admin'] = false;
        $_POST['confirmed'] = false;
        $_POST['confirmekey'] = $confirmekey;
        $_POST['mdp'] = password_hash($_POST['mdp'] . self::$sel, PASSWORD_DEFAULT);
        $view='inscripted';
        $pagetitle='Résultat';
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && ModelUtilisateur::save($_POST)){
            $mail = $_POST["mail"];
            $tab_o = ModelUtilisateur::selectAll();
            $lien = "https://webinfo.iutmontp.univ-montp2.fr/~bernarda/eCommerce/index.php?controller=utilisateur&action=verify&mail=$mail&key=$confirmekey";
            mail ($mail ,"Lien d'activation de compte","Cliquez sur le lien suivant : $lien");
            require File::build_path(array("view","view.php"));
        }
        else self::inscription();
    }

    public static function verify(){
        $o = ModelUtilisateur::select($_GET['mail']);
        if ($o == NULL) erreur::printerror("Aucun compte n'a pour mail {$_GET['mail']}");
        if ($o->getConfirmeKey() != $_GET['key']) erreur::printerror("Mauvaise clé !");
        $data['mail'] = $_GET['mail'];
        $data['mdp'] = $o->getMdp();
        $data['nom'] = $o->getNom();
        $data['prenom'] = $o->getPrenom();
        $data['admin'] = false;
        $data['confirmekey'] = "";
        $data['confirmed'] = true;
        ModelUtilisateur::update($data);
        $view='confirme';
        require File::build_path(array("view","view.php"));
    }
}
?>