<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 1:45 AM
 */

use Bramus\Router\Router;
/**
 * bramus/router composer package
 * */
$router = new Router();

$router->set404(function() {
//    $controller = new FormController();
//    echo $controller->index();
});
$router->run();
