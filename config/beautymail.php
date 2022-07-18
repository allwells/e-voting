<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#6961fd',
        'button'    => '#5850ec',

    ],

    'view' => [
        'senderName'  => config('app.name'),
        'reminder'    => null,
        'unsubscribe' => null,
        'address'     => null,

        'logo'        => [
            'path'   => '%PUBLIC%/vendor/beautymail/assets/images/minty/evoting-logo.png',
            'width'  => '100',
            'height' => '50',
        ],

        'twitter'  => null,
        'facebook' => null,
        'flickr'   => null,
    ],

];
