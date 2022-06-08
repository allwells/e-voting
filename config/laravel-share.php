<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | Specify the base uri for each service.
    |
    |
    |
    */

    'services' => [
        'facebook' => [
            'uri' => 'https://facebook.com/sharer/sharer.php?u=',
        ],
        'twitter' => [
            'uri' => 'https://twitter.com/intent/tweet',
            'text' => 'Default share text',
        ],
        'linkedin' => [
            'uri' => 'http://www.linkedin.com/shareArticle', // oud: http://www.linkedin.com/shareArticle
            'extra' => ['mini' => 'true'],
        ],
        'whatsapp' => [
            'uri' => 'https://api.whatsapp.com/send?text=',
            'extra' => ['mini' => 'true'],
        ],
        'pinterest' => [
            'uri' => 'https://pinterest.com/pin/create/button/?url=',
        ],
        'reddit' => [
            'uri' => 'https://www.reddit.com/submit',
            'text' => 'Default share text',
        ],
        'telegram' => [
            'uri' => 'https://telegram.me/share/url',
            'text' => 'Default share text',
        ],
        'email' => [
            'uri' => 'mailto:?subject=&body=',
            'subject' => 'Default share mail subject',
            'body' => 'Default share mail body',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Font Awesome
    |--------------------------------------------------------------------------
    |
    | Specify the version of Font Awesome that you want to use.
    | We support version 4 and 5.
    |
    |
    */

    'fontAwesomeVersion' => 5,
];
