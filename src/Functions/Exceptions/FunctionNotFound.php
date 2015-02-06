<?php

namespace AdamQuaile\PhpGlobal\Functions\Exceptions;

class FunctionNotFound extends \RuntimeException
{
    public function __construct($functionName)
    {
        parent::__construct("The function \\$functionName does not exist");
    }

}