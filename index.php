<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 1:33 AM
 */

use App\Controllers\CsvProcessingController;
//use App\CsvReader\CsvReader;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_include_path(get_include_path().PATH_SEPARATOR.'public/views'.PATH_SEPARATOR.'public/views/layouts');
require 'vendor/autoload.php';
require './router.php';



