<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
    {{\Vrnvgasu\Localization\Services\Locale\Locale::getLangName()}}
</a>
<div class="dropdown-menu bg-dark">
    @foreach(config('vrnvgasu_localization.locales') as $localeName => $localeAttr)
        <a class="dropdown-item text-light" href="{{ route('vrnvgasu.locales.change', $localeName) }}">{{$localeAttr['name']}}</a>
    @endforeach
</div>
