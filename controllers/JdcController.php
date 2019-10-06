<?php

namespace controllers;

use classes\Models;
use Models\JdcService;

require_once("models/JdcService.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JdcController
 *
 * @author spook
 */
class JdcController {

    public function index() {
        $classTypModels = new Models();
        $JdcService = new JdcService($classTypModels);
        $games = $JdcService->getAll();
        include_once ('views/JdC.html');
        return;
    }

}
