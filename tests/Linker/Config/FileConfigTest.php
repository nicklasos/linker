<?php
namespace Linker\Config;

class FileConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileConfig
     */
    private $config;

    protected function setUp()
    {
        parent::setUp();

        $this->config = new FileConfig('example', 'tests/fixtures');
    }

    public function testLoadConfig()
    {
        $config = $this->config->get();

        $this->assertArrayHasKey('url', $config);
        $this->assertArrayHasKey('locale', $config);
        $this->assertArrayHasKey('os', $config);
        $this->assertArrayHasKey('child', $config);

        $this->assertTrue(is_array($config['child']));
    }
}
