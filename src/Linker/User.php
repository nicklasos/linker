<?php
namespace Linker;

use Jenssegers\Agent\Agent;

class User
{
    /**
     * @var Agent
     */
    private $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function getLocale()
    {
        $languages = $this->agent->languages();

        if (!$languages) {
            return null;
        }

        $locales = array_values(array_filter($languages, function ($l) {
            return strlen($l) == 2;
        }));

        return in($locales, 0);
    }

    public function getOS()
    {
        if ($this->agent->isAndroidOS()) {
            return 'android';
        }

        if ($this->agent->isiOS()) {
            return 'ios';
        }

        if ($this->agent->is('Windows')) {
            return 'windows';
        }

        if ($this->agent->is('OS X')) {
            return 'macos';
        }

        return null;
    }

    public function getPlatform()
    {
        if ($this->agent->isPhone()) {
            return 'phone';
        }

        if ($this->agent->isTablet()) {
            return 'tablet';
        }

        if ($this->agent->isMobile()) {
            return 'mobile';
        }

        if ($this->agent->isDesktop()) {
            return 'desktop';
        }

        if ($this->agent->isRobot()) {
            return 'robot';
        }

        return null;
    }
}
