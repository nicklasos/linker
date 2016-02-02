<?php
namespace Linker;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function testUrl()
    {
        $_SERVER['PATH_INFO'] = '/foobar';

        $this->assertEquals('foobar', url());
    }
}
