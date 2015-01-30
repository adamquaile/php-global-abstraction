<?php

namespace AdamQuaile\PhpGlobal\Tests;

use AdamQuaile\PhpGlobal\Constants\ConstantWrapper;

class ConstantWrapperTest extends \PHPUnit_Framework_TestCase
{
    private $wrapper;

    protected function setUp()
    {
        $this->wrapper = new ConstantWrapper();
    }

    private function newConstantName()
    {
        return md5(uniqid());
    }

    public function testConstantIsSet()
    {
        $key = $this->newConstantName();

        $this->assertFalse(defined($key));
        $this->wrapper->set($key, 17);
        $this->assertTrue(defined($key), 'Constant was not set');
    }

    /**
     * @depends testConstantIsSet
     */
    public function testConstantIsSetToCorrectValue()
    {
        $key = $this->newConstantName();

        $this->wrapper->set($key, 'my value');
        $this->assertSame('my value', constant($key));
    }

    public function testConstantIsAccessible()
    {
        $key = $this->newConstantName();
        define($key, 'some value');

        $this->assertSame('some value', $this->wrapper->get($key));
    }

    public function testAccessingUndefinedConstantThrowsException()
    {
        $this->setExpectedException('AdamQuaile\PhpGlobal\Constants\Exceptions\ConstantNotYetDefined');
        $this->wrapper->get('undefined');
    }

    public function testSettingAlreadyDefinedConstantThrowsException()
    {
        $key = $this->newConstantName();
        define($key, 'value');
        $this->setExpectedException('AdamQuaile\PhpGlobal\Constants\Exceptions\ConstantAlreadyDefined');
        $this->wrapper->set($key, 'value');
    }

    public function testIsDefinedReportsTrueWhenDefined()
    {
        define($key = $this->newConstantName(), 'value');
        $this->assertTrue($this->wrapper->isDefined($key));
    }

    public function testIsDefinedReportsFalseWhenNotDefined()
    {
        $key = $this->newConstantName();
        $this->assertFalse($this->wrapper->isDefined($key));
    }


}