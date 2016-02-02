<?php
namespace Linker\Config;

class ConfigBlock
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getUrl()
    {
        return $this->get('url');
    }

    public function getOS()
    {
        return $this->get('os');
    }

    public function getPlatform()
    {
        return $this->get('platform');
    }

    public function getLocale()
    {
        return $this->get('locale');
    }

    /**
     * @return ConfigBlock|null
     */
    public function child()
    {
        if ($child = $this->get('child')) {
            return new ConfigBlock($child);
        }

        return null;
    }

    private function get($param, $default = null)
    {
        return in($this->config, $param, $default);
    }
}
