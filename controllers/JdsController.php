<?php

namespace controllers;

use classes\Models;
use Models\JdsService;

require_once("models/JdsService.php");

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
class JdsController {

    public function index() {
        $classTypModels = new Models();
        $JdsService = new JdsService($classTypModels);
        $games = $JdsService->getAll();
        include_once ('views/JdS.html');
        return;
    }
}
