<?php

namespace Models;

use classes\Models;

class GererService {

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
    public function getJdcJds() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT jeu_id, jeu_nom, jeu_jdm
                    FROM jeu 
                    WHERE jeu_cat = "jeu de cartes" OR jeu_cat = "jeu de societe"'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
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

    public function setJdm($jdm) {
        $query = 'UPDATE jeu SET jeu_jdm = 0;';
        foreach ($jdm as $id) {
            $query .= "UPDATE jeu SET jeu_jdm = 1 WHERE jeu_id = " . $id . ";";
        }
        $query = $this->getModels()->getBdd()->prepare($query);
        $query->execute();
    }

    public function insertNewGame($name, $cat, $age, $nbr_min, $nbr_max, $tps, $genr, $des) {
        //on insert en Bdd
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO jeu (jeu_nom, jeu_cat, jeu_age, jeu_nbr_min, jeu_nbr_max, jeu_tem, jeu_genr, jeu_des) VALUES (:name, :cat, :age, :nbr_min, :nbr_max, :tps, :genr, :des)");

        $insert->execute([
            'name' => $name,
            'cat' => $cat,
            'age' => $age,
            'nbr_min' => $nbr_min,
            'nbr_max' => $nbr_max,
            'tps' => $tps,
            'genr' => $genr,
            'des' => $des,
        ]);
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
