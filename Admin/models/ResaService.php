<?php

namespace Models;

use classes\Models;

class ResaService {

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
    public function getAllResa() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT resa_id, resa_nom, resa_jour, resa_heure_deb, resa_heure_fin, resa_tel
                    FROM resa_jdr
                    ORDER BY resa_jour'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function deletResa($id) {
        $query = $this->getModels()->getBdd()->prepare(
                'DELETE FROM resa_jdr WHERE resa_id = :id'
        );
        $query->execute(['id'=> $id]);
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
