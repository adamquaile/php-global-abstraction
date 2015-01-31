<?php

namespace AdamQuaile\PhpGlobal\Functions\Exceptions;

class FunctionAlreadyExists extends \RuntimeException
{
    public function __construct($functionName)
    {
        parent::__construct("The function \\$functionName is already defined");
    }

}