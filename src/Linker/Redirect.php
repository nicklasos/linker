<?php
namespace Linker;

use Linker\Config\ConfigBlock;

class Redirect
{
    /**
     * @var ConfigBlock
     */
    private $configBlock;

    /**
     * @var User
     */
    private $user;

    public function __construct(ConfigBlock $configBlock, User $user)
    {

        $this->configBlock = $configBlock;
        $this->user = $user;
    }

    public function getUrl()
    {
        do {
            $url = $this->configBlock->getUrl();

            $configOS = $this->configBlock->getOS();
            if ($configOS && $configOS != $this->user->getOS()) {
                continue;
            }

            $configLocale = $this->configBlock->getLocale();
            if ($configLocale != $this->user->getLocale()) {
                continue;
            }

            $configPlatform = $this->configBlock->getPlatform();
            if ($configPlatform && $configPlatform != $this->user->getPlatform()) {
                continue;
            }

            break;
        } while ($this->configBlock = $this->configBlock->child());

        return $url;
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }
}
