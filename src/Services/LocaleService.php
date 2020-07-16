<?php

namespace Vrnvgasu\Localization\Services;

use Symfony\Component\HttpFoundation\Cookie;
use Vrnvgasu\Localization\Contracts\LocaleServiceContract;
use Vrnvgasu\Localization\Services\Locale\Locale;

/**
 * Class LocaleService
 * @package Vrnvgasu\Localization\Services
 */
class LocaleService implements LocaleServiceContract
{
    /**
     * @var Locale
     */
    protected $locale;

    /**
     * LocaleService constructor.
     * @param Locale $locale
     */
    public function __construct(Locale $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param string $locale
     * @return Cookie
     */
    public function setLocale(string $locale): Cookie
    {
        return $this->locale->setLocale($locale);
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return $this->locale->getLocale();
    }
}
