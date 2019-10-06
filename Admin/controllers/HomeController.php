<?php

namespace controllers;

use classes\Models;
use Models\MessService;

require_once("models/MessService.php");

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
class HomeController {

    public function index() {
        $classTypModels = new Models();
        $MessService = new MessService($classTypModels);
        $cont = $MessService->getAllMess();
        include_once ('views/mess.html');
        return;
    }

    public function delMess() {
        if (!empty($_POST['id'])) {

            $classTypModels = new Models();
            $MessService = new MessService($classTypModels);
            $MessService->delmess($_POST['id']);
        }
    }

    public function respond() {

        if (!empty($_POST['mail']) && !empty($_POST['subject']) && !empty($_POST['mess'])) {
            $subject = trim($_POST['subject']);
            if ($subject == '') {
                http_response_code(400);
                return;
            }
            $mess = trim($_POST['mess']);
            if ($mess == '') {
                http_response_code(400);
                return;
            }
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) == false) {
                http_response_code(400);
                return;
            }
            mail($_POST['mail'], $subject, $mess);
            return;
        }
        http_response_code(400);
    }

}
