<?php

namespace Models;

use classes\Models;

class MessService {

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
    public function getAllMess() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT cont_id, cont_mail, cont_mess
                    FROM contact'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delmess($id) {
        $query = $this->getModels()->getBdd()->prepare(
                'DELETE FROM contact WHERE cont_id = :id'
        );
        $query->execute(['id' => $id]);
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



