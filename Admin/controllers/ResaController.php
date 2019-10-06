<?php

namespace controllers;

use classes\Models;
use Models\ResaService;

require_once("models/ResaService.php");
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
class ResaController {

    public function index() {
        $classTypModels = new Models();
        $ResaService = new ResaService($classTypModels);
        $resa = $ResaService->getAllResa();
        include_once ('views/resa.html');
        return;
    }
    public function deletResa() {
        if (!empty($_POST['id'])) {

            $classTypModels = new Models();
            $ResaService = new ResaService($classTypModels);
            $ResaService->deletResa($_POST['id']);
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
