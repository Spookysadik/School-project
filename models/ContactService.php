<?php

namespace Models;

use classes\Models;

class ContactService {

    private $models;
    private $errors = [];

    /**
     * ResaService constructor.
     * @param \Models $models
     */
    public function __construct(Models $models) {
        $this->models = $models;
    }

    public function insertMessage($mail, $comment) {
        //on insert en Bdd
        $insert = $this->getModels()->getBdd()->prepare("INSERT INTO contact (cont_mail, cont_mess) VALUES (:mail, :comment)");

        $insert->execute([
            'mail' => $mail,
            'comment' => $comment,
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

    /*


      // define variables and set to empty values
      $nameErr = $emailErr = "";
      $name = $email = $comment = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["name"])) {
      $nameErr = "Name is required";
      } else {
      $name = test_input($_POST["name"]);
      }

      if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      } else {
      $email = test_input($_POST["email"]);
      }

      if (empty($_POST["comment"])) {
      $comment = "Empty";
      } else {
      $comment = test_input($_POST["comment"]);
      }
      $Subject = "New Message Received";

      // prepare email body text
      $Body = "";
      $Body .= "Name: ";
      $Body .= $name;
      $Body .= "\n";
      $Body .= "Email: ";
      $Body .= $email;
      $Body .= "\n";
      $Body .= "Comment: ";
      $Body .= $comment;
      $Body .= "\n";

      // redirect to success page
      if ($success && $errorMSG == "") {
      echo "success";
      } else {
      if ($errorMSG == "") {
      echo "Something went wrong :(";
      } else {
      echo $errorMSG;
      }
      }
      }
     */
}
