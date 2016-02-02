<?php
namespace Linker;

use Jenssegers\Agent\Agent;
use Linker\Config\ConfigBlock;
use Linker\Config\FileConfig;

class RedirectTest extends \PHPUnit_Framework_TestCase
{
    public function testEnAndroid()
    {
        $this->assertEquals('http://google.com/en', $this->getRedirect([
            'os' => 'AndroidOS',
            'locale' => 'en',
        ])->getUrl());

        $this->assertEquals('http://google.com/ru', $this->getRedirect([
            'os' => 'AndroidOS',
            'locale' => 'ru',
        ])->getUrl());

        $this->assertEquals('http://apple.com/en', $this->getRedirect([
            'os' => 'iOS',
            'locale' => 'en',
        ])->getUrl());

        $this->assertEquals('http://apple.com/ru', $this->getRedirect([
            'os' => 'iOS',
            'locale' => 'ru',
        ])->getUrl());
    }

    public function testDefault()
    {
        $url = $this->getRedirect([
            'os' => 'windows',
            'locale' => 'uk',
        ])->getUrl();

        $this->assertEquals('http://microsoft.com', $url);
    }

    public function testEmptyConfig()
    {
        $this->assertEquals('http://google.com/ru', $this->getRedirect([
            'os' => 'AndroidOS',
            'locale' => 'ru',
            'config' => 'locale-only',
        ])->getUrl());

        $this->assertEquals('http://google.com/en', $this->getRedirect([
            'os' => 'iOS',
            'locale' => 'en',
            'config' => 'locale-only',
        ])->getUrl());
    }

    public function testEmptyConfigDefault()
    {
        $url = $this->getRedirect([
            'os' => 'iOS',
            'locale' => 'zh',
            'config' => 'locale-only',
        ])->getUrl();

        $this->assertEquals('http://microsoft.com', $url);
    }

    public function testPlatform()
    {
        $this->assertEquals('http://apple.com', $this->getRedirect([
            'platform' => 'Phone',
            'config' => 'platform',
        ])->getUrl());

        $this->assertEquals('http://google.com', $this->getRedirect([
            'platform' => 'Tablet',
            'config' => 'platform',
        ])->getUrl());

        $this->assertEquals('http://android.com', $this->getRedirect([
            'platform' => 'Mobile',
            'config' => 'platform',
        ])->getUrl());


        $url = $this->getRedirect([
            'platform' => 'Desktop',
            'config' => 'platform',
        ])->getUrl();

        $this->assertEquals('http://microsoft.com', $url);
    }

    /**
     * @param array $params
     * @return Redirect
     */
    private function getRedirect(array $params)
    {
        $user = new User($this->getStubbedAgent($params));

        $configBlock = new ConfigBlock((new FileConfig(in($params, 'config', 'example'), 'tests/fixtures'))->get());

        return new Redirect($configBlock, $user);
    }

    /**
     * @param array $params
     * @return Agent
     */
    private function getStubbedAgent(array $params)
    {
        $stub = $this->getMockBuilder(Agent::class)
            ->setMethods([
                'languages',
                'isAndroidOS',
                'isiOS',
                'isPhone',
                'isTablet',
                'isDesktop',
                'isMobile',
            ])
            ->getMock();

        if (isset($params['locale'])) {
            $stub->method('languages')->willReturn([$params['locale']]);
        }

        if (isset($params['os'])) {
            $stub->method("is{$params['os']}")->willReturn(true);
        }

        if (isset($params['platform'])) {
            $stub->method("is{$params['platform']}")->willReturn(true);
        }

        return $stub;
    }
}
