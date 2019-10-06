<?php

namespace classes;
// Se connecte à la DB
// Paramètres : nom de la base -> $_dbName
class Models {
// Déclaration des paramètres de connexion
    private $_host = "185.98.131.91",
        $_user = "gaell1114025",
        $_pass = "Lolita23q",
        $_dbName = "gaell1114025",
        $_bdd;

    public function __construct() {
        $this->setBdd();
    }

    /* GETTER */

    public function getBdd() {
        return $this->_bdd;
    }

    /* SETTER */

    private function setBdd() {
// Exécute une requète SQL. Si la requête ne passe pas, renvoir le message d'erreur MySQL
// Paramètres : chaine SQL -> $strSQL
// Renvoie : enregistrements correspondants -> $result
        $options = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ];
        // Error treatment
        try {
            $dbConnect = new \PDO(
                    'mysql:host=' . $this->_host . ';dbname=' . $this->_dbName, $this->_user, $this->_pass, $options
            );
        } catch (\PDOException $e) {
            die('Erreur SQL dans le fichier ' . $e->getFile() . ' à la ligne ' . $e->getLine() . ' - ' . $e->getMessage());
        }
        $this->_bdd = $dbConnect;
    }

}
