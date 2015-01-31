<?php

namespace AdamQuaile\PhpGlobal\Functions;

use AdamQuaile\PhpGlobal\Functions\Exceptions\FunctionAlreadyExists;

class FunctionWrapper
{
    public function create($callable, $name = null)
    {
        if (is_null($name)) {
            $name = 'func_' . md5(uniqid());
        }
        if (function_exists($name)) {
            throw new FunctionAlreadyExists($name);
        }
        $uniqueFunctionName = 'func_' . md5(uniqid());

        $GLOBALS[$uniqueFunctionName] = $callable;

        eval("function $name() { return call_user_func_array(\$GLOBALS['$uniqueFunctionName'], func_get_args()); }");

        return $name;
    }
}