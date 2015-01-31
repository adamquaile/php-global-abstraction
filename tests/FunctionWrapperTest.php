<?php

namespace AdamQuaile\PhpGlobal\Tests;

use AdamQuaile\PhpGlobal\Functions\FunctionWrapper;

class FunctionWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FunctionWrapper
     */
    private $functions;

    protected function setUp()
    {
        $this->functions = new FunctionWrapper();
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

    public function methodCallable()
    {
        return 'value';
    }

}