<?php

namespace classes;

class Models {

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
