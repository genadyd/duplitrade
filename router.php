<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 1:45 AM
 */


/**
 * bramus/router composer package
 * */

use App\Controllers\CsvProcessingController;
use App\Controllers\ProfitCalculationController;
use Bramus\Router\Router;

$router = new Router();

$router->get('/',function() {
    $controller = new CsvProcessingController();
    $controller->processor();
});
$router->get('/calc',function() {
    $controller = new ProfitCalculationController();
    $controller->index();
});

$router->set404(function() {
    echo 'aaaa';
});
$router->run();
