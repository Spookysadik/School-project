<?php

namespace Models;

use classes\Models;

class JdcService {

    private $models;
    private $errors = [];

    /**
     * ResaService constructor.
     * @param \Models $models
     */
    public function __construct(Models $models) {
        $this->models = $models;
    }

    /**
     * @param string $username
     * @param string $pass
     * @return mixed
     */
    public function getAll() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT jeu_id, jeu_nom,jeu_img, jeu_age, jeu_nbr_min, jeu_nbr_max, jeu_tem, jeu_des 
                    FROM jeu 
                    WHERE jeu_cat = "jeu de cartes"'
        );
        $query->execute();
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
