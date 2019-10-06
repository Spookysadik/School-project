<?php

use classes\Router;

require_once('classes/Autoloader.php');
include_once('classes/Router.php');
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
        <title>Valet de Carreau</title>
        <base href="/backVDC/">
        <link rel="icon" type="image/png" href="img/icone/Asset.png">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/VDC.css">
        <link rel="stylesheet" href="css/jeu.css">
        <link rel="stylesheet" href="css/bootstrap-grid.css">
        <link rel="stylesheet" href="css/bootstrap-reboot.css">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--script src="script/jquery-3.3.1.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="script/bootstrap.js"></script>
        <script src="script/bootstrap.bundle.js"></script>
        <?php
        $router = new Router();
        print $router->controllerReturn((isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '');
        require('views/footer.html')
        ?>
        <a id="back-to-top" href="#" class="btn btn-blu back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><i class="fas fa-chevron-up"></i></a>

        <script src="script/VDC.js"></script>   
    </body>
</html>
