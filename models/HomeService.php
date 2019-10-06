<?php

namespace Models;

use classes\Models;

class HomeService {

    private $models;
    private $errors = [];

    /**
     * ResaService constructor.
     * @param \Models $models
     */
    public function __construct(Models $models) {
        $this->models = $models;
    }

    public function getJdm() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT jeu_nom, jeu_img, jeu_des 
                    FROM jeu
                    WHERE jeu_jdm = 1'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAutocomplete($str) {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT jeu_nom, jeu_id, jeu_cat
                    FROM jeu
                    WHERE jeu_nom LIKE :str
                    LIMIT 10'
        );
        $query->execute(["str" => "%" . $str . "%"]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return Models
     */
    public function getModels() {
        return $this->models;
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors) {
        $this->errors[] = $errors;
    }

}
