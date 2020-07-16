<?php

namespace Vrnvgasu\Localization\Contracts;

use Symfony\Component\HttpFoundation\Cookie;

/**
 * Interface LocaleService
 */
interface LocaleServiceContract
{
    /**
     * @param string $locale
     * @return Cookie
     */
    public function setLocale(string $locale): Cookie;

    /**
     * @return string|null
     */
    public function getLocale(): ?string;
}
