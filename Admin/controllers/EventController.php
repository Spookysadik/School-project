<?php

namespace controllers;

use classes\Models;
use Models\EventService;

require_once("models/EventService.php");
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
class EventController {

    public function index() {
        $classTypModels = new Models();
        $EventService = new EventService($classTypModels);
        $event = $EventService->getAllEvent();
        include_once ('views/event.html');
        return;
    }

    public function createNewEvent() {
        if (!empty($_POST['name']) && !empty($_POST['day'])) {
            $name = trim($_POST['name']);
            if ($name == '') {
                http_response_code(400);
                return;
            }

            $classTypModels = new Models();
            $EventService = new EventService($classTypModels);
            $day = \DateTime::createFromFormat("d/m/Y", $_POST['day']);
            if ($day <= date('Y-m-d H:i:s')) {
                http_response_code(400);
                return;
            }
            $EventService->insertNewEvent($name, $day);
            return;
        }
        http_response_code(400);
    }

    public function deletEvent() {
        if (!empty($_POST['id'])) {

            $classTypModels = new Models();
            $EventService = new EventService($classTypModels);
            $EventService->deletEvent($_POST['id']);
        }
    }

}
