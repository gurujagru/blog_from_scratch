<?php

use blog\core\Router;

session_start();
/*require_once('../core/autoloader.php');*/
require_once  __DIR__ . '/../vendor/autoload.php';
Router::doRouting();


