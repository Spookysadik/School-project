<?php

use controllers\AuthenController;
namespace classes;

// routeur qui appel le bon controller
class AdminRouter {

    public function controllerReturn($query = '') {
        session_start();
        //initialisation des variables par deffaut
        $controller = 'Home';
        $method = 'index';

        //découpage du path_info avec comme délimiteur / et en supprimant les / en début et fin du path_info
        $explodeQuery = explode('/', trim($query, '/'));

        //on vérifie qu'il y a bien un controller
        if (isset($explodeQuery[00]) && !empty($explodeQuery[0])) {
            $controller = ucfirst($explodeQuery[0]);
        }
        //on vérifie qu'il y a bien une méthode
        if (isset($explodeQuery[1]) && !empty($explodeQuery[1])) {
            $method = $explodeQuery[1];
        }

        if (!isset($_SESSION['connected']))
        {
            $controllerObject = new \controllers\AuthenController();
            if ($controller == "Authen" && $method == "login")
            {
                $controllerObject->login();
                return;
            }
            $controllerObject->index();
            return;
        }

        //on catch les exceptions
        //try {
            //on refabrique le bon nom du controller
            $controller .= 'Controller';

            //on inclut le fichier du controller
            require_once ('controllers/' . $controller . '.php');

            //on prépare une variable avec le path de la classe du controller
            $controller = '\\controllers\\' . $controller;

            //instantiation du controller
            $object = new $controller();

            //on appelle la méthode du controller et on retourne son résultat
            return $object->$method();
//        } catch (\Exception $exception) {
//            require_once ('controllers/ErrorsController.php');
//
//            $controller = '\\controllers\\ErrorsController';
//            $object = new $controller();
//            return $object->$method();
//        }
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

