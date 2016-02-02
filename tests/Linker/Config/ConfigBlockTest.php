<?php
namespace Linker\Config;

class ConfigBlockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigBlock
     */
    private $config;

    protected function setUp()
    {
        parent::setUp();

        $this->config = new ConfigBlock((new FileConfig('example', 'tests/fixtures'))->get());
    }

    public function testBlock()
    {
        $this->assertEquals('http://google.com/ru', $this->config->getUrl());
        $this->assertEquals('android', $this->config->getOS());
        $this->assertEquals('ru', $this->config->getLocale());
    }

    public function testChild()
    {
        $this->assertEquals('ru', $this->config->getLocale());

        $config = $this->config->child();

        $this->assertInstanceOf(ConfigBlock::class, $config);
        $this->assertEquals('en', $config->getLocale());

        $lastConfig = $config->child()->child()->child();

        $this->assertEquals('http://microsoft.com', $lastConfig->getUrl());

        $this->assertNull($lastConfig->child());
    }
}
