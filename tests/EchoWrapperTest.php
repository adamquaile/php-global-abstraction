<?php

namespace AdamQuaile\PhpGlobal\Tests;

use AdamQuaile\PhpGlobal\Output\EchoWrapper;

class EchoWrapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EchoWrapper
     */
    private $output;

    public function setUp()
    {
        $this->output = new EchoWrapper();
    }

    public function testWrapperOutputsSingleParameter()
    {
        ob_start();
        $this->output->output('Some string');
        $this->assertSame('Some string', ob_get_clean());
    }

    public function testWrapperOutputsMultipleParameter()
    {
        ob_start();
        $this->output->output('Some string', 'Another string');
        $this->assertSame('Some stringAnother string', ob_get_clean());
    }
}