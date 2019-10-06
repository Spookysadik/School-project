<?php

use classes\AdminRouter;

require_once('../classes/Autoloader.php');
include_once('classes/AdminRouter.php');

$router = new AdminRouter();
print $router->controllerReturn((isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '');

?>