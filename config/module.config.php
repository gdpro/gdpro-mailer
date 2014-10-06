<?php
return [
    'gdpro_monolog' => include 'gdpro_monolog.config.php',
    'gdpro_mailer' => include 'gdpro_mailer.config.php',
    'service_manager' => include 'service_manager.config.php',
    'console' => include 'console.config.php',
    'slm_queue' => include 'slm_queue.config.php',

    'controllers' => [
        'factories' => [
            'GdproMailer\Command\SendMail' => 'GdproMailer\Factory\Command\SendMailCommandFactory'
        ]
    ],

    'view_manager' => [
        'template_map' => [
            'gdpro_mail/mail/example' => __DIR__ . '/../view/mail/example.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
