<?php

namespace Vrnvgasu\Localization\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Vrnvgasu\Localization\Contracts\LocaleServiceContract;

/**
 * Class LocaleController
 * @package Vrnvgasu\Localization\Controllers
 */
class LocaleController extends Controller
{
    /**
     * @var LocaleServiceContract
     */
    protected $service;

    /**
     * LocaleController constructor.
     * @param LocaleServiceContract $service
     */
    public function __construct(LocaleServiceContract $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $locale
     * @return RedirectResponse
     */
    public function change(string $locale): RedirectResponse
    {
        $cookie = $this->service->setLocale($locale);

        if ($user = Auth::user()) {
            $user->locale = $locale;
            $user->save();
        }

        return redirect()->back()->withCookies([$cookie]);
    }
}
