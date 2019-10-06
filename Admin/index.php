<?php

use classes\AdminRouter;

require_once('../classes/Autoloader.php');
include_once('classes/AdminRouter.php');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Vdc website">
        <meta name="author" content="SpookySadik">
        <title>Admin VDC</title>
        <base href="/backvdc/Admin/">
        <link rel="icon" type="image/png" href="img/icone/Asset.png">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <script src="js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="js/bootstrap.js"></script>

        <?php
        $router = new AdminRouter();
        print $router->controllerReturn((isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '');
        ?>
        <script src="js/admin.js" type="text/javascript"></script>

    </body>
</html>
