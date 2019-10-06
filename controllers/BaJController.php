<?php

namespace controllers;

use classes\Models;
use Models\BajService;

require_once("models/BajService.php");

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
class BaJController {

    public function index() {
        $classTypModels = new Models();
        $BajService = new BajService($classTypModels);
        $event = $BajService->getCurrentEvent();
        include_once ('views/BaJ.html');
        return;
    }

    public function createNewResa() {
        if (!empty($_POST['name']) && !empty($_POST['nbr']) && !empty($_POST['id'])) {
            $name = trim($_POST['name']);
            if($name == '')
            {
                http_response_code(400);
                return;
            }
            $nbr = intval($_POST['nbr']);
            if($nbr === NULL || $nbr <= 0 || $nbr > 10)
            {
                http_response_code(400);
                return;
            }
            $id = intval($_POST['id']);
            if($id === NULL)
            {
                http_response_code(400);
                return;
            }
            $classTypModels = new Models();
            $BajService = new BajService($classTypModels);

            if ($BajService->insertNewResa($name, $nbr, $id) == false){
                http_response_code(400);
            }
            return;
        }
        http_response_code(400);
    }
    

}
