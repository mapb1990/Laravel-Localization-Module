# Laravel Localization

Easy i18n localization for Laravel 4.

## Instalation

In app/config/app.php, replace the following entry from the `providers` key:

    'Illuminate\Translation\TranslationServiceProvider',

with:

    'Borges\Localization\LocalizationServiceProvider',

and add the next facade in the `aliases` key:

    'Locale'          => 'Borges\Localization\Facades\Locale',

You may publish the package's configuration if you so choose, using artisan CLI:

    php artisan config:publish borges/localization


## Usage

### Translation

This translations package is designed to adapt to your workflow. Translations are accessed just like in Laravel, with replacements and pluralization working as expected. The only difference is that languages ​​can be inherited.

#### Example

**app/en/app.php**
```php
return array(
    'color'     => 'Colour',
    'hello'     => 'Hello',
    'welcome'   => 'Welcome',
    'another-string' => 'Another String'
);
```

**app/en-US/app.php**
```php
return array(
    'color'     => 'Color'
);
```

**app/pt/app.php**
```php
return array(
    'color'     => 'Cor',
    'hello'     => 'Olá',
    'welcome'   => 'Bem-vindo'
);
```

```php
echo Lang::get('app.welcome');  # prints 'Welcome'
echo Lang::get('app.color');  # prints 'Colour'
echo Lang::get('app.hello');  # prints 'Hello'
App::setLocale('en-US');
echo Lang::get('app.welcome');  # prints 'Welcome'
echo Lang::get('app.color');  # prints 'Color'
echo Lang::get('app.hello');  # prints 'Hello'
App::setLocale('pt');
echo Lang::get('app.welcome');  # prints 'Bem-vindo'
echo Lang::get('app.color');  # prints 'Cor'
echo Lang::get('app.hello');  # prints 'Olá'

echo Lang::get('another-string');  # prints 'Another String' if 'useDefault' is true or else prints 'another-string'
```

### Another resources (dates, numbers, ...)

This package provides a local resource formatter for dates and numbers.

#### Example    

```php
echo Locale::number(1234567.890); # prints '1, 234, 567.89'
echo Locale::int(1234567.890); # prints '1, 234, 568'
echo Locale::date(Carbon\Carbon::now()); # prints 'Tuesday, December 17, 2013'
App::setLocale('en-US');
echo Locale::number(1234567.890); # prints '1, 234, 567.89'
echo Locale::int(1234567.890); # prints '1, 234, 568'
echo Locale::date(Carbon\Carbon::now()); # prints 'Tuesday, December 17, 2013'
App::setLocale('pt');
echo Locale::number(1234567.890); # prints '1 234 567,89'
echo Locale::int(1234567.890); # prints '1 234 568'
echo Locale::date(Carbon\Carbon::now()); # prints '17 de Dezembro de 2013'
```

### Helpers

This package provides a collection of helpers functions. See [helpers.php](https://github.com/mapb1990/Laravel-Localization-Module/blob/master/src/Borges/Localization/helpers.php).

## Changelog

### v0.1.0 (17-12-2013)

* Initial release

## Support or Contact

If you have any questions or found any bug, please contact me via [twitter](https://twitter.com/mapb_1990) or [github issues system](https://github.com/mapb1990/Laravel-Localization-Module/issues).

[![Support via PayPal](https://rawgithub.com/chris---/Donation-Badges/master/paypal.jpeg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=SBTFEMJL6LXPG&lc=PT&item_name=borges%2flocalization%20package&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)