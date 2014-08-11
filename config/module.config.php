<?php
return [
    'gdpro_mailer' => [
        'email_sending_activated' => true,

        'smtp' => [
            'default' => [
                'domain_name' => 'socialcar.com',
                'host' => 'smtp.googlemail.com',
                'username' => 'gary.gitton@gmail.com',
                'password' => 'ggianray'
            ]
        ],
//        /* Define your templates to use with the message renderer */
//        'templates' => [
//
//            /* Replace templateName by the name of your template */
//            'template_example' => [
//
//                /* Define the subject of your message
//                'subject' => 'Social Car - Validation de votre inscription',
//
//                /* Define the view template to use for the template */
//                /*
//                'view' => 'gdpro_mail/mail/example',
//            ]
//        ]


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
        'invokables' => [
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

