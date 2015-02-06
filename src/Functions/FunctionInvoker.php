<?php

namespace AdamQuaile\PhpGlobal\Functions;

use AdamQuaile\PhpGlobal\Functions\Exceptions\FunctionNotFound;

class FunctionInvoker
{
    public function invoke($callable, $args = array())
    {
        if (is_string($callable)) {
            if (!function_exists($callable)) {
                throw new FunctionNotFound($callable);
            }
        }

        return call_user_func_array($callable, $args);
    }
}