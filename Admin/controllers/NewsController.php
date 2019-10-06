<?php

namespace controllers;

use classes\Models;
use Models\NewsService;

require_once("models/NewsService.php");
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
class NewsController {

    public function index() {
        $classTypModels = new Models();
        $NewsService = new NewsService($classTypModels);
        $news = $NewsService->getAllMail();
        include_once ('views/newsletter.html');
        return;
    }

    public function delMail() {
        if (!empty($_POST['id'])) {

            $classTypModels = new Models();
            $NewsService = new NewsService($classTypModels);
            $NewsService->delmail($_POST['id']);
        }
    }

    public function Sendletter() {
        if (!empty($_POST['title']) && !empty($_POST['lettre'])) {
            $title = trim($_POST['title']);
            if ($title == '') {
                http_response_code(400);
                return;
            }
            $lettre = trim($_POST['lettre']);
            if ($lettre == '') {
                http_response_code(400);
                return;
            }
            $classTypModels = new Models();
            $NewsService = new NewsService($classTypModels);
            $news = $NewsService->getAllMail();
            //pas de serveur mail
            foreach ($news as $n) {
                mail($n['mail_adres'], $title, $lettre);
            }
            return;
        }
        http_response_code(400);
    }

}
