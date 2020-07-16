<?php

namespace Vrnvgasu\Localization\Middleware;

use Closure;
use Illuminate\Http\Request;
use Vrnvgasu\Localization\Contracts\LocaleServiceContract;

/**
 * Class Localization
 * @package Vrnvgasu\Localization\Middleware
 */
class Localization
{
    const ALIAS = 'vrnvgasu_localization';

    /**
     * @var LocaleServiceContract
     */
    private $localeService;

    /**
     * Localization constructor.
     * @param LocaleServiceContract $localeService
     */
    public function __construct(LocaleServiceContract $localeService)
    {
        $this->localeService = $localeService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!($locale = $this->localeService->getLocale())) {
            $locale = $request->user()->locale ?? config('vrnvgasu_localization.default');
        }

        $cookie = $this->localeService->setLocale($locale);

        return $next($request)->withCookie($cookie);
    }
}
