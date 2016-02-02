<?php
namespace Linker\Config;

class FileConfig
{
    private $config;

    public function __construct($filePath, $folder = 'config')
    {
        $path = ROOT . '/' . $folder . '/' . str_replace('.', '', $filePath) . '.json';

        if (!file_exists($path)) {
            throw new \InvalidArgumentException('File does not exists');
        }

        $this->config = json_decode(file_get_contents($path), true);
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->config;
    }
}
