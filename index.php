<?php
use blog\core\Router;
session_start();
require_once('core/autoloader.php');
//require_once('core/router.php');
Router::doRouting();
?>

