<?php
require_once File::build_path(array("config","conf.php"));
class Modelcommande extends Model {

    private $amount;
    private $id_farlane;
    private $mail_utilisateur;
    protected static $object = "commande";
    protected static $primary='id_farlane';

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getAmount() {
        return $this->amount;
    }

    function ajouterArticle($libelleProduit,$qteProduit,$prixProduit)
    {

        //Si le panier existe
        if (creationPanier()) {
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            } else {
                //Sinon on ajoute le produit
                array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            }
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
}
?>