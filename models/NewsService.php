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

    public function insertNewsletter($news) {
        //on insert en Bdd
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO newsletter (mail_adres) VALUES (:news)");
        $insert->execute([
            'news' => $news,
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

    /* $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      }
      if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      }
      } */
}
