<?php
namespace blog\core;

use HTMLPurifier_Config;
use HTMLPurifier;

class Purifier
{
    public static function run($dirty_html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($dirty_html);
        return $clean_html;
    }
}