<?php

namespace AdamQuaile\PhpGlobal\Tests;

use AdamQuaile\PhpGlobal\Functions\FunctionCreator;
use AdamQuaile\PhpGlobal\Functions\FunctionInvoker;
use AdamQuaile\PhpGlobal\Functions\FunctionWrapper;

class FunctionWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FunctionWrapper
     */
    private $functions;

    private $spyWasCalled = false;

    private $spyArgs = null;

    protected function setUp()
    {
        $this->functions = new FunctionWrapper(
            new FunctionCreator(),
            new FunctionInvoker()
        );
    }

    public function testCreatesFunctionFromClosure()
    {
        $this->functions->create(function($number) {
            return $number * 2;
        }, 'global_scope_function');

        $this->assertTrue(function_exists('global_scope_function'));
        $this->assertSame(4, \global_scope_function(2));
    }

    public function testCreatesFunctionFromArrayCallableSyntax()
    {
        $this->functions->create(array($this, 'methodCallable'), 'other_global_func');
        $this->assertTrue(function_exists('other_global_func'));
        $this->assertSame('value', \other_global_func());
    }

    public function testThrowsExceptionWhenFunctionAlreadyExists()
    {
        eval("function alreadyExists() {}");

        $this->setExpectedException('AdamQuaile\PhpGlobal\Functions\Exceptions\FunctionAlreadyExists');
        $this->functions->create(function() {}, 'alreadyExists');
    }

    public function testReturnsAnAutomaticallyGeneratedFunctionNameIfNotSpecified()
    {
        $funcName = $this->functions->create(function() {return 'auto';});
        $this->assertTrue(function_exists($funcName));
        $this->assertSame('auto', $funcName());
    }

    /**
     * @depends testCreatesFunctionFromArrayCallableSyntax
     */
    public function testFunctionCanBeInvokedAndReturnsResult()
    {
        $functionToInvoke = $this->functions->create(array($this, 'spyFunction'));
        $this->assertEquals('spied', $this->functions->invoke($functionToInvoke));
        $this->assertTrue($this->spyWasCalled);
    }

    /**
     * @depends testCreatesFunctionFromArrayCallableSyntax
     */
    public function testFunctionCanBeInvokedWithParameters()
    {
        $functionToInvoke = $this->functions->create(array($this, 'spyFunction'));
        $this->functions->invoke($functionToInvoke, array('my', 'params'));
        $this->assertTrue($this->spyWasCalled);
        $this->assertEquals($this->spyArgs, array('my', 'params'));
    }


    public function testThrowsExceptionWhenFunctionNotFound()
    {
        $this->setExpectedException('AdamQuaile\PhpGlobal\Functions\Exceptions\FunctionNotFound');
        $this->functions->invoke('not_found_function');
    }



    public function spyFunction()
    {
        $this->spyWasCalled = true;
        $this->spyArgs = func_get_args();

        return 'spied';
    }

    public function methodCallable()
    {
        return 'value';
    }

}