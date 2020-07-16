# Localization

A simple button for changing language for Laravel projects.

Russian and English are supported by default.
But you can expand localization.

## Installation
#### Install library
```
composer require vrnvgasu/localization
```

#### Except encrypting localization cookie  
Add middleware cookie name `\Vrnvgasu\Localization\Services\Locale\Locale::USER_LOCALE`
to `$except` array for \App\Http\Middleware\EncryptCookies if you use 
this middleware.

```php
namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Vrnvgasu\Localization\Services\Locale\Locale;

class EncryptCookies extends Middleware
{
    protected $except = [
        Locale::USER_LOCALE,
    ];
}
```

#### Run migrations
By default, a locale column will be added to the users table.
If this column exists, no migration is required.
If the user table is named differently, 
then you need to make changes to the configs 
(detailed description in configuring the configs).

```
php artisan migrate
```

#### Set middleware
Set middleware for routes that support localization.

```php
use Illuminate\Support\Facades\Route;
use Vrnvgasu\Localization\Middleware\Localization;

Route::group(array(
    'middleware' => Localization::ALIAS,
), function() {
    //
});
```

#### Config management
Publish config to your project

```
php artisan vendor:publish --tag=vrnvgasu_localization__config
```
The `config/vrnvgasu_localization.php` will be published.

Then you can add new locales in `locales` array:
```php
    'locales' => [
        'en' => [
            'lang' => 'lang',
            'name' => 'en',
        ],
        'ru' => [
            'lang' => 'яз',
            'name' => 'рус',
        ],
        'new_locale' => [
            'lang' => 'drop_down_button_name',
            'name' => 'language_name',
        ],
    ],
```

Change default locale:
```php
'default' => 'new_locale',
```

Change users table name (is necessary for migration):
```php
'users_table' => 'users_table_name',
```

#### Include language button
Use `@include('vrnvgasu::localization.index')` in your blade.

```blade
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            @include('vrnvgasu::localization.index')
        </li>
    </ul>
</nav>
```

#### View management
Publish view to your project
```
php artisan vendor:publish --tag=vrnvgasu_localization__view
```
The `resources/views/vendor/vrnvgasu/localization/index.blade.php` 
will be published.

You can change this view.
`@include('vrnvgasu::localization.index')` will use your template.


