<?php
return [
    'gdpro_mailer' => [
        'email_sending_activated' => true,

        'smtp' => [
            'default' => [
                'domain_name' => 'gary.pro',
                'host' => 'smtp.googlemail.com',
                'username' => 'gary.gitton@gmail.com',
                'port' => '25',
                'password' => ''
            ]
        ],
//        /* Define your templates to use with the message renderer */
//        'templates' => [
//
//            /* Replace templateName by the name of your template */
//            'template_example' => [
//
//                /* Define the subject of your message
//                'subject' => 'gdpro - Validation de votre inscription',
//
//                /* Define the view template to use for the template */
//                /*
//                'view' => 'gdpro_mail/mail/example',
//            ]
//        ]
        'queue' => [
            'name'          => 'gdpro_mailer',
            'driverOptions' => array(
                'host'      => '127.0.0.1',
                'port'      => '3306',
                'username'  => 'queue',
                'password'  => 'queue',
                'dbname'    => 'queue',
                'type'      => 'pdo_mysql'
            )
        ]
    ],

    'view_manager' => [
        'template_map' => [
//            /* Here we define the view to be used with the template */
//            'gdpro_mail/mail/example' => __DIR__ . '/../view/mail/example.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'service_manager' => [
        'aliases' => [
            'gdpro_mailer.service.mailer' => 'gdpro_mailer.mailer_service',
            'gdpro_mailer.renderer.message' => 'gdpro_mailer.message_renderer',
            'gdpro_mailer.manager.smtp' => 'gdpro_mailer.smtp_manager'
        ],
        'factories' => [
            // Smtp (Transport)
            'gdpro_mailer.smtp_manager' => 'GdproMailer\Factory\SmtpManagerFactory',

            // Message
            'gdpro_mailer.message_renderer' => 'GdproMailer\Factory\MessageRendererFactory',

            // Service
            'gdpro_mailer.mailer_service' => 'GdproMailer\Factory\MailerServiceFactory',
        ]
    ]
];
