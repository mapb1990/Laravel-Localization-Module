<?php

return array(
    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    // Default language
    'locale'           => 'en',

    // Use default language if the translation line doesn't exist
    'useDefault'       => true,

    // Languages that are allowed in routes
    'availableLocales' => array('en'), // array('en', 'en-US', 'pt'),

    /*
    |--------------------------------------------------------------------------
    | Application use system Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    // Use user language 
    // Set to false, to use Session Language
    'useUserLanguage'       => false,
    // 'useUserLanguage'       => function () { 
    //     if(Auth::check()) {
    //         return Auth::user()->language;
    //     }
    //     return false;
    // },

    // Take the browser language if it's not defined in the route? 
    // If false, system will take app.php locale attribute 
    'useSessionLanguage'    => false,

    // Take the browser language if it's not defined in the route? 
    // If false, system will take app.php locale attribute 
    'useBrowserLanguage'    => false,

    /*
    |--------------------------------------------------------------------------
    | Application Locales Definitions
    |--------------------------------------------------------------------------
    | http://www.i18nguy.com/unicode/language-identifiers.html
    */
    'locales' => array(
        'en' => array(
            'name' => 'English',
            'iso_code' => 'en',
            'language_code' => 'en',
            'date_format' => '%m/%e/%Y',
            'time_format' => '%l:%M %p',
            'datetime_format' => '%m/%e/%Y, %l:%M %p',
            'date_longformat' => '%A, %B %e, %Y',
            'time_longformat' => '%l:%M:%S %p',
            'datetime_longformat' => '%A, %B %e, %Y at %l:%M %p',
            'dec_point' => '.',
            'thousands_sep' => ', '),
        'en-US' => array(
            'name' => 'English (United States)',
            'inherit' => 'en',
            'iso_code' => 'en',
            'language_code' => 'en-US'),
        'pt' => array(
            'name' => 'Português',
            'iso_code' => 'pt',
            'language_code' => 'pt',
            'date_format' => '%d-%m-%Y',
            'time_format' => '%H:%M',
            'datetime_format' => '%d-%m-%Y, %H:%M',
            'date_longformat' => '%d de %B de %Y',
            'time_longformat' => '%H:%M:%S',
            'datetime_longformat' => '%d de %B de %Y às %H:%M',
            'dec_point' => ',',
            'thousands_sep' => ' '),
    )
);
