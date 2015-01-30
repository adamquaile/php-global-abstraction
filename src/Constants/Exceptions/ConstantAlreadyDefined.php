<?php

namespace AdamQuaile\PhpGlobal\Constants\Exceptions;

class ConstantAlreadyDefined extends \RuntimeException
{
    public function __construct($key)
    {
        parent::__construct("The constant $key is already defined");
    }
}
