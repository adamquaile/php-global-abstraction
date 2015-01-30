<?php

namespace AdamQuaile\PhpGlobal\Constants\Exceptions;

class ConstantNotYetDefined extends \RuntimeException
{
    public function __construct($key)
    {
        parent::__construct("The constant $key is not yet defined");
    }
}