<?php
use blog\core\Router;

session_start();
require_once('../core/autoloader.php');
Router::doRouting();


