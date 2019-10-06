<?php

namespace controllers;

use classes\Models;
use Models\JdrService;

require_once("models/JdrService.php");

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
class JdrController {

    public function index() {
        include_once ('views/JdR.html');
        return;
    }

    public function getByGenr() {
        $classTypModels = new Models();
        $JdrService = new JdrService($classTypModels);
        if (!empty($_GET['genr'])) {
            $values = $JdrService->getByGenr($_GET['genr']);
            echo json_encode($values);
        }
        return;
    }

    public function getFreeSched() {
        $classTypModels = new Models();
        $JdrService = new JdrService($classTypModels);
        if (!empty($_GET['date'])) {
            $date = \DateTime::createFromFormat("d/m/Y", $_GET['date']);
            $values = $JdrService->getAllResaByDate($date);
            $array = array(false, false, false, false, false, false, false, false, false, false);
            foreach ($values as $value) {
                $heure_deb = \DateTime::createFromFormat("H:i:s", $value['resa_heure_deb']);
                $heure_fin = \DateTime::createFromFormat("H:i:s", $value['resa_heure_fin']);
                $start_index = idate("H", $heure_deb->getTimestamp()) - 10;
                $end_index = idate("H", $heure_fin->getTimestamp()) - 10;
                for ($i = $start_index; $i < $end_index; $i++) {
                    $array[$i] = true;
                }
            }
            echo json_encode($array);
            return;
        }
    }

    public function createNewResa() {
        if (!empty($_POST['name']) && !empty($_POST['day']) && !empty($_POST['hour']) && !empty($_POST['nbr']) && !empty($_POST['tel'])) {
            $name = trim($_POST['name']);
            if ($name == '') {
                http_response_code(400);
                return;
            }

            $day = \DateTime::createFromFormat("Y-d-m", $_POST['day']);
            if ($day === false) {
                http_response_code(400);
                return;
            }

            $heure_deb = \DateTime::createFromFormat("H", $_POST['hour']);
            if ($heure_deb === false) {
                http_response_code(400);
                return;
            }

            $heure_fin = \DateTime::createFromFormat("H", $_POST['hour']);
            if ($heure_fin === false) {
                http_response_code(400);
                return;
            }

            $nbr = intval($_POST['nbr']);
            if ($nbr === NULL || ($nbr != 1 && $nbr != 2)) {
                http_response_code(400);
                return;
            }
            $heure_fin->add(new \DateInterval("PT{$nbr}H"));

            $tel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
            $tel = str_replace("-", "", $tel);
            $tel = str_replace("+", "", $tel);
            if (strlen($tel) != 10) {
                http_response_code(400);
                return;
            }
            
            if($day <= date('Y-m-d H:i:s')) {
                http_response_code(400);
                return;
            }
            
            $classTypModels = new Models();
            $JdrService = new JdrService($classTypModels);
            $JdrService->insertNewResa($name, $tel, $day, $heure_deb, $heure_fin);
            return;
        }
        http_response_code(400);
    }

}
