<?php

namespace Models;

use classes\Models;

class NewsService {

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
    public function getAllMail() {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT mail_id, mail_adres
                    FROM newsletter'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function delmail($id) {
        $query = $this->getModels()->getBdd()->prepare(
                'DELETE FROM newsletter WHERE mail_id = :id'
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