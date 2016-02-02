<?php
namespace Linker;

use Jenssegers\Agent\Agent;
use AspectMock\Test as test;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = new User($this->getStubbedAgent());
    }

    public function testLocale()
    {
        $this->assertEquals('ru', $this->user->getLocale());
    }

    public function testOS()
    {
        $this->assertEquals('android', $this->user->getOS());
    }

    public function testPlatform()
    {
        $this->assertEquals('mobile', $this->user->getPlatform());
    }

    /**
     * @return Agent
     */
    private function getStubbedAgent()
    {
        $stub = $this->getMockBuilder(Agent::class)
            ->setMethods(['languages', 'isAndroidOS', 'isMobile', 'isPhone'])
            ->getMock();

        $stub->method('isPhone')->willReturn(false);
        $stub->method('isMobile')->willReturn(true);
        $stub->method('languages')->willReturn(['ru-ru', 'ru']);
        $stub->method('isAndroidOS')->willReturn(true);

        return $stub;
    }
}
