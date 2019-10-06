<?php

namespace controllers;

use classes\Models;
use Models\HomeService;
use Models\BajService;
use Models\NewsService;


require_once("models/HomeService.php");
require_once("models/BajService.php");
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
class HomeController {

    public function index() {
        $classTypModels = new Models();
        $HomeService = new HomeService($classTypModels);
        $jdm = $HomeService->getJdm();
        $BajService = new BajService($classTypModels);
        $event = $BajService->getCurrentEvent();
        include_once ('views/VDC.html');
        return;
    }

    public function createNewsletter() {
        if (!empty($_POST['news'])) {
            if (filter_var($_POST['news'], FILTER_VALIDATE_EMAIL) == false)
            {
                http_response_code(400);
                return;
            }
            $classTypModels = new Models();
            $NewsService = new NewsService($classTypModels);
            $NewsService->insertNewsletter($_POST['news']);
            return;
        }
        http_response_code(400);
    }

    public function getAutocomplete() {
        if (!empty($_GET['str'])) {

            $classTypModels = new Models();
            $HomeService = new HomeService($classTypModels);
            $values = $HomeService->getAutocomplete($_GET['str']);
            echo json_encode($values);
        }
    }

    /* public static function displayPage($models) {
      /* var_dump($_GET); affiche les infos de la page
      $menu = GetManagement::getMenu();
      require_once (self::PAGES[$menu]['href']);
      }

      public static function displayNav() {
      ?>
      <ul>
      <?php
      $menu = GetManagement::getMenu();
      foreach (self::PAGES as $key => $value) {
      /*$classes=($menu==$key)? 'active':'';
      if ($menu == $key) {
      $active = 'active';
      } else {
      $active = 'noactive';
      }
      ?>
      <li class="<?php echo $active ?> " >
      <a href="index.php?menu=<?php echo $key; ?>">
      <?php echo $value['titre']; ?></a></li><?php
      }
      ?>
      </ul>


      <?php
      } */
}
