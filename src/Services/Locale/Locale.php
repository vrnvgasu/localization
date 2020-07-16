<?php

namespace Vrnvgasu\Localization\Services\Locale;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as HttpCookie;

/**
 * Class Locale
 * @package Vrnvgasu\Localization\Services\Locale
 */
class Locale
{
    const COOKIE_TIME = 12 * 60 * 30;
    const USER_LOCALE = 'vrnvgasu_locale';

    /**
     * @return string|null
     */
    public static function getLangName(): string
    {
        $instance = new static;
        $locale = App::getLocale();
        $config = config('vrnvgasu_localization');

        if (!is_string($locale) || !$instance->localeIsAvailable($locale)) {
            return $config['locales'][$config['default']]['name'];
        }

        $langName = $config['locales'][$locale]['name'] ?? $config['locales'][$config['default']]['name'];

        return $langName;
    }

    /**
     * @return array
     */
    public function getAvailableLocales(): array
    {
        return collect(config('vrnvgasu_localization.locales'))
            ->keys()->toArray();
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function localeIsAvailable(string $locale): bool
    {
        return in_array($locale, $this->getAvailableLocales());
    }

    /**
     * @param string $locale
     * @return HttpCookie
     */
    public function setLocale(string $locale): HttpCookie
    {
        if (!$this->localeIsAvailable($locale)) {
            throw new LocaleException($locale . ' is not available');
        }

        App::setLocale($locale);

        return cookie(static::USER_LOCALE, $locale, static::COOKIE_TIME);
    }

    /**
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return Cookie::get(static::USER_LOCALE);
    }
}
