<?php

namespace Models;

use classes\Models;

class AuthenService {

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
    public function getPassword($email) {
        $query = $this->getModels()->getBdd()->prepare(
                'SELECT admin_mdp
                    FROM admin_co
                    WHERE admin_mail = :email'
        );
        $query->execute(['email' => $email]);
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
