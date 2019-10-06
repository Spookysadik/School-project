<?php

namespace controllers;

use classes\Models;
use Models\GererService;

require_once("models/GererService.php");

/**
 * Description of HomeController
 *
 * @author spook
 */
class GererController {

    public function index() {
        $classTypModels = new Models();
        $GererService = new GererService($classTypModels);
        $jdm = $GererService->getJdm();
        $games = $GererService->getJdcJds();
        include_once ('views/gerer.html');
        return;
    }

    public function setJdm() {
        if (!empty($_POST['jdm'])) {
            $classTypModels = new Models();
            $GererService = new GererService($classTypModels);
            $GererService->setJdm($_POST['jdm']);
            $jdm = $GererService->getJdm();
            echo json_encode($jdm);
        }
    }

    public function createNewGame() {
        if (!empty($_POST['name']) && !empty($_POST['cat'])) {
            $name = trim($_POST['name']);
            if ($name == '') {
                http_response_code(400);
                return;
            }
            $cat = trim($_POST['cat']);
            if ($cat == '' || ($cat != "jeu de cartes" && $cat != "jeu de societe" && $cat != "jeu de role")) {
                http_response_code(400);
                return;
            }
            $age = null;
            $nbr_min = null;
            $nbr_max = null;
            $tps = null;
            $genr = null;
            $des = null;
            switch ($cat) {
                case "jeu de cartes":
                case "jeu de societe":
                    if (empty($_POST['age']) || empty($_POST['nbr_min']) || empty($_POST['nbr_max']) || empty($_POST['tps']) || empty($_POST['des'])) {
                        http_response_code(400);
                        return;
                    }
                    $age = intval($_POST['age']);
                    if ($age === null || $age <= 0) {
                        http_response_code(400);
                        return;
                    }
                    $nbr_min = intval($_POST['nbr_min']);
                    if ($nbr_min === null || $nbr_min <= 0) {
                        http_response_code(400);
                        return;
                    }
                    $nbr_max = intval($_POST['nbr_max']);
                    if ($nbr_max === null || $nbr_max <= 0) {
                        http_response_code(400);
                        return;
                    }
                    if ($nbr_min >= $nbr_max) {
                        http_response_code(400);
                        return;
                    }
                    $tps = intval($_POST['tps']);
                    if ($tps === null || $tps <= 0) {
                        http_response_code(400);
                        return;
                    }
                    $des = trim($_POST['des']);
                    if ($des == '') {
                        http_response_code(400);
                        return;
                    }
                    break;
                case "jeu de role":
                    if (empty($_POST['genr'])) {
                        http_response_code(400);
                        return;
                    }
                    $genr = trim($_POST['genr']);
                    if ($genr == '' || ($genr != "medieval fantastique" && $genr != "autres" && $genr != "contemporain" && $genr != "science fiction")) {
                        http_response_code(400);
                        return;
                    }
                    break;
            }
            $classTypModels = new Models();
            $GererService = new GererService($classTypModels);
            $GererService->insertNewGame($name, $cat, $age, $nbr_min, $nbr_max, $tps, $genr, $des);
            return;
        }
        http_response_code(400);
    }

}
