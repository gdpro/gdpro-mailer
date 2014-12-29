<?php
return [
    'loggers' => [
        'gdpro_mailer' => [
            'name' => 'Mailer Logger',
            'handlers' => [
                'gdpro_mailer'
            ]
        ]
    ],
    'handlers' => [
        'gdpro_mailer' => [
            'args' => [
                'stream' =>  'data/log/mailer.log'
            ]
        ]
    ]
];