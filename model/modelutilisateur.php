<?php
require_once File::build_path(array("model","model.php"));
class ModelUtilisateur extends model {
	private $mail;
	private $mdp;
	private $nom;
	private $prenom;
    private $admin;
    private $confirmeKey;
    private $confirmed;
	protected static $object = "utilisateur";
	protected static $primary='mail';

	public function getMail() {
		return $this->mail;
	}

    public function getMdp() {
        return $this->mdp;
    }

	public function getNom() {
		return $this->nom;  
	}

	public function getPrenom() {
		return $this->prenom;  
	}

    public function getAdmin() {
        return $this->admin;
    }

    public function getConfirmeKey() {
        return $this->confirmeKey;
    }

    public function getConfirmed() {
        return $this->confirmed;
    }
}
?>