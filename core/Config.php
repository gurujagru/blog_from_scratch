<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 08-Oct-17
 * Time: 11:26 AM
 */

namespace blog\core;


class Config
{
    private $data;
    private static $instance;

    private function __construct()
    {
        $this->data = require_once('routes.php');
    }
    public static function getInstance()
    {
        if (self::$instance == null){
            self::$instance = new Config();
        }
        return self::$instance;
    }
    public function getDataConfig()
    {
        return $this->data;
    }
}