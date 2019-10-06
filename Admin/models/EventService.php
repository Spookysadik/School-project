<?php

namespace Models;

use classes\Models;

class EventService {

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
    public function getAllEvent() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT event.event_id, event.event_nom, event.event_date, SUM(event_resa.event_resa_nbr) as resa_nbr
                    FROM event LEFT JOIN event_resa ON event.event_id = event_resa.fk_event_id GROUP BY event.event_id ORDER BY event.event_date'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insertNewEvent($name, $day) {
        //on insert en Bdd
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO event (event_nom, event_date, event_nbr_seat) VALUES (:name, :day, 50)");

        $insert->execute([
            'name' => $name,
            'day' => $day->format("Y-m-d"),
        ]);
    }

    public function deletEvent($id) {
        $query = $this->getModels()->getBdd()->prepare(
                'DELETE FROM event WHERE event_id = :id'
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
