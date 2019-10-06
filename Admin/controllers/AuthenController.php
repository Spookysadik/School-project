<?php

namespace controllers;

use classes\Models;
use Models\AuthenService;
use controllers\HomeController;

require_once("models/AuthenService.php");
require_once("controllers/HomeController.php");

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
class AuthenController {

    public function index() {
        include_once ('views/authen.html');
        return;
    }

    public function login() {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
                http_response_code(400);
                return;
            }
            $password = $_POST['password'];
            if ($password == '') {
                http_response_code(400);
                return;
            }
            $classTypModels = new Models();
            $AuthenService = new AuthenService($classTypModels);
            $pass = $AuthenService->getPassword($_POST['email']);
            if(count($pass) != 0)
            {
                if($pass[0]['admin_mdp'] == $password)
                {
                    $_SESSION['connected'] = true;
                    return;
                }            
            }
        }
        http_response_code(400);
    }
    
    public function disconnect()
    {
        unset($_SESSION['connected']);
        session_destroy();
        $this->index();
    }

}
