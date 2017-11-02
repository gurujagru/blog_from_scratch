<?php
namespace blog\core\exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct($message = "")
    {
        $message = $message ? : 'Undefined error!';
        parent::__construct($message);
    }
}