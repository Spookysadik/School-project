<?php

namespace Models;

use classes\Models;

class BajService {

    private $models;
    private $errors = [];

    /**
     * ResaService constructor.
     * @param \Models $models
     */
    public function __construct(Models $models) {
        $this->models = $models;
    }

    public function getCurrentEvent() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT event_id, event_nom, event_date
                    FROM event
                    WHERE event_date > :date
                    ORDER BY event_date
                    LIMIT 4'
        );
        $query->execute([
            'date' => date('Y-m-d')
        ]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertNewResa($name, $nbr, $id) {
        //on insert en Bdd
        //check si l'event existe
        $query = $this->getModels()->getBdd()->prepare("SELECT event_id FROM event WHERE event_id = :id");
        $query->execute(['id' => $id]);
        if (count($query->fetchAll(\PDO::FETCH_ASSOC)) == 0)
            return false;
        $query = $this->getModels()->getBdd()->prepare("SELECT SUM(event_resa_nbr) as resa_nbr FROM event_resa WHERE fk_event_id = :id");
        $query->execute(['id' => $id]);
        $res = $query->fetch();
        $res = intval($res["resa_nbr"]);
        if($res === null || $res + $nbr > 50)
            return false;
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO event_resa (event_resa_nom, event_resa_nbr, fk_event_id) VALUES (:name, :nbr, :id)");

        return $insert->execute([
                    'name' => $name,
                    'id' => $id,
                    'nbr' => $nbr
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
