<?php

namespace controllers;

use classes\Models;
use Models\ContactService;

require_once("models/ContactService.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author spook
 */
class ContactController {

    public function index() {
        include_once ('views/Contact.html');
        return;
    }

    public function insertMessage() {
        if (!empty($_POST['mail']) && !empty($_POST['comment'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) == false) {
                http_response_code(400);
                return;
            }
            $comment = trim($_POST['comment']);
            if (strlen($comment) < 20 || strlen($comment) > 500) {
                http_response_code(400);
                return;
            }
            $classTypModels = new Models();
            $ContactService = new ContactService($classTypModels);
            $ContactService->insertMessage($_POST['mail'], $comment);
            return;
        }
        http_response_code(400);
    }

}
