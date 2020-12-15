<?php
Class Error{
    protected static $object = "error";
    public static function printerror($ErrorMessage) {
        $pagetitle='Erreur';
        $view = 'error';
        require File::build_path(array("view","view.php"));
        die();
    }

    public static function printErrorIfNotAdmin(){
        if (!isset($_SESSION['mail']) || !$_SESSION['admin'])
            self::printerror("Vous devez être administrateur pour afficher cette page.");
    }

    public static function printErrorIfNotConnected(){
        if (!isset($_SESSION['mail']))
            self::printerror("Vous n'êtes pas connecté !");
    }

    public static function printErrorIfAlreadyConnected(){
        if (isset($_SESSION['mail']))
            self::printerror("Vous êtes déjà connecté !");
    }
}
?>