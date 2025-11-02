<?php

return [
    /*
     *  Supported locales are listed here.
     */
    'supportedLocales' => [
        'en' => [
            'name' => 'English',
            'script' => 'Latn',
            'native' => 'English',
            'regional' => 'en_US',
        ],
        'nl' => [
            'name' => 'Dutch',
            'script' => 'Latn',
            'native' => 'Nederlands',
            'regional' => 'nl_NL',
        ],
        'fr' => [
            'name' => 'French',
            'script' => 'Latn',
            'native' => 'Français',
            'regional' => 'fr_FR',
        ],
    ],

    /*
     *  Negotiate for the user locale using the Accept-Language header if it's not defined in the URL?
     *  If false, system will take app.php locale attribute
     */
    'useAcceptLanguageHeader' => false,

    /*
     *  If LaravelLocalizationRedirectMiddleware is active and hideDefaultLocaleInURL
     *  is true, the url would not have the default application language
     */
    'hideDefaultLocaleInURL' => true,

    /*
     *  The separator of the locale in the URL
     */
    'localesOrder' => ['en', 'nl', 'fr'],

    /*
     *  The separator of the locale in the URL
     */
    'urlSeparator' => '/',

    /*
     *  Set the locale of the application.
     */
    'locale' => 'en',
];
