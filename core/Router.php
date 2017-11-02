<?php
namespace blog\core;

class Router
{
    public static function getUri()
    {
        $request = substr($_SERVER['REQUEST_URI'],1);
        $routes = Config::getInstance();
        $routes = $routes->getDataConfig();
        $arguments = [];
        $foundRoute  = null;
        foreach ($routes as $route){
            if(preg_match($route['Pattern'],$request,$arguments)) {
                $foundRoute = $route;
                break;
            }
        }
        if ($foundRoute == null){
                die('404 not found');
            }
            unset($arguments[0]);
            $arguments=array_values($arguments);
        return $niz = array(
            'foundRoute'=>$foundRoute,
            'arguments'=>$arguments);
    }

    public static function getController()
    {
        $foundRoute = self::getUri();
        $controllerPath = '../controllers/'. $foundRoute['foundRoute']['Controller'] . 'Controller.php';
        if (!file_exists($controllerPath)){
            die('Controller not found!');
        }
        require_once $controllerPath;
        $imeKlase = 'blog\\controllers\\' . $foundRoute['foundRoute']['Controller'] . 'Controller';
        $objekat = new $imeKlase();
        return $objekat;
    }

    public static function doRouting()
    {
        $foundRoute = self::getUri();
        $objekat = self::getController();
        if (method_exists($objekat,$foundRoute['foundRoute']['Method'])){
            $methodName = $foundRoute['foundRoute']['Method'];
            call_user_func_array([$objekat,$methodName],$foundRoute['arguments']);
        } else {
            die('This controller does not have the requested method');
        }
        $data = $objekat->getData();
        require '../views/' . lcfirst($foundRoute['foundRoute']['Controller']) . '/' . $foundRoute['foundRoute']['Method'] . '.php';
    }
}