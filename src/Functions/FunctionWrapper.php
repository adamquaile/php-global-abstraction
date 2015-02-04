<?php

namespace AdamQuaile\PhpGlobal\Functions;

class FunctionWrapper
{
    /**
     * @var FunctionCreator
     */
    private $creator;

    /**
     * @var FunctionInvoker
     */
    private $invoker;

    public function __construct(FunctionCreator $creator, FunctionInvoker $invoker)
    {
        $this->creator = $creator;
        $this->invoker = $invoker;
    }

    public function create($callable, $name = null)
    {
        return $this->creator->create($callable, $name);
    }

    public function invoke($callable, $args = array())
    {
        return $this->invoker->invoke($callable, $args);
    }
}