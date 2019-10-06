<?php

use classes\Router;

require_once('classes/Autoloader.php');
include_once('classes/Router.php');

$router = new Router();
print $router->controllerReturn((isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '');

?>
