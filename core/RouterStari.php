<?php

$request = substr($_SERVER['REQUEST_URI'],1);
$routes = require_once 'routes.php';
$arguments = [];
$foundRoute = null;
foreach($routes as $route){
    if(preg_match($route['Pattern'], $request, $arguments)){
        $foundRoute=$route;
        break;
    }
}
if ($foundRoute == null){
    die('404 not found');
}
unset($arguments[0]);
$arguments=array_values($arguments);

$controllerPath='controllers/' . $foundRoute['Controller'] . 'Controller.php';
if(!file_exists($controllerPath)) {
    die('Controller class does not exists.');
    }

require_once $controllerPath;
    $imeKlase = 'blog\\controllers\\'.$foundRoute['Controller'] . 'Controller';
    $objekat = new $imeKlase;



if(method_exists($objekat, $foundRoute['Method'])) {
    $methodName = $foundRoute['Method'];
    call_user_func_array([$objekat, $methodName], $arguments);
}
else {
die('This controller does not have the requested method');
}


$data = $objekat->getData();

require 'views/' . lcfirst($foundRoute['Controller']) . '/' . $foundRoute['Method'] . '.php';