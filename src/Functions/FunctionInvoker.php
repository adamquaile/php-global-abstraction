<?php

namespace AdamQuaile\PhpGlobal\Functions;

class FunctionInvoker
{
    public function invoke($callable, $args = array())
    {
        return call_user_func_array($callable, $args);
    }
}