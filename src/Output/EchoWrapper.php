<?php

namespace AdamQuaile\PhpGlobal\Output;

class EchoWrapper
{
    public function output()
    {
        foreach (func_get_args() as $arg) {
            echo $arg;
        }
    }
}