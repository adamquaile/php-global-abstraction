<?php

namespace AdamQuaile\PhpGlobal\Constants;

use AdamQuaile\PhpGlobal\Constants\Exceptions\ConstantAlreadyDefined;
use AdamQuaile\PhpGlobal\Constants\Exceptions\ConstantNotYetDefined;

class ConstantWrapper
{
    public function isDefined($key)
    {
        return defined($key);
    }
    public function set($key, $value)
    {
        if (defined($key)) {
            throw new ConstantAlreadyDefined($key);
        }
        define($key, $value);
    }

    public function get($key)
    {
        if (!defined($key)) {
            throw new ConstantNotYetDefined($key);
        }
        return constant($key);
    }
}