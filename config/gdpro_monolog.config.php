<?php
return [
    'loggers' => [
        'gdpro_mailer' => [
            'name' => 'Mailer Logger',
            'handlers' => [
                'default'
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