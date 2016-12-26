<?php
return [
    'console' => [
        'router' => [
            'routes' => [
                'my-first-route' => [
                    'type'    => 'simple',
                    'options' => [
                        'route'    => 'gdpro mailer send mail <templateName> <recipient> <smtpName> <vars>',
                        'defaults' => [
                            'controller' => 'gdpro_mailer.command.send_mail',
                            'action'     => 'index'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            'gdpro_mailer.command.send_mail' => 'GdproMailer\Factory\Command\SendMailCommandFactory'
        ]
    ],
    'gdpro_mailer' => [
        'email_sending_activated' => true,

        'smtp' => [
            'default' => [
                'domain_name' => '',
                'host' => 'smtp.googlemail.com',
                'username' => '',
                'port' => '25',
                'password' => ''
            ]
        ],
        /* Define your templates to use with the message renderer */
        'templates' => [

            /* Replace templateName by the name of your template */
            'example' => [

                /* Define the subject of your message */
                'subject' => 'gdpro - Validation de votre inscription',

                /* Define the view template to use for the template */
                'view' => 'gdpro_mail/mail/example',
            ]
        ]
    ],
    'gdpro_monolog' => [
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
    ],
    'service_manager' => [
        'aliases' => [
            'gdpro_mailer.service.mailer' => 'gdpro_mailer.mailer_service',
            'gdpro_mailer.renderer.message' => 'gdpro_mailer.message_renderer',
            'gdpro_mailer.manager.smtp' => 'gdpro_mailer.smtp_manager'
        ],
        'invokables' => [
            'gdpro_mailer.logger.mailer' => 'GdproMailer\Logger\MailerLogger',
        ],
        'factories' => [
            // Smtp (Transport)
            'gdpro_mailer.smtp_manager' => 'GdproMailer\Factory\SmtpManagerFactory',

            // Message
            'gdpro_mailer.message_renderer' => 'GdproMailer\Factory\MessageRendererFactory',

            // Service
            'gdpro_mailer.mailer_service' => 'GdproMailer\Factory\MailerServiceFactory',
        ]
    ],
    'slm_queue' => [
        'job_manager' => [
            'aliases' => [
                'GdproMailer\Job\SendMailJob' => 'gdpro_mailer.job.send_mail'
            ],

            /**
             * Allow to configure dependencies for jobs that are pulled from any queue. This works like any other
             * PluginManager in Zend Framework 2. For instance, if you want to inject something into every job using
             * a factory, just adds an element into the "factories" array, with the key being the FQCN of the job,
             * and the value the factory:
             *
             */
            'factories' => [
                'gdpro_mailer.job.send_mail' => 'GdproMailer\Factory\Job\SendMailJobFactory'
            ]
        ],

        'queue_manager' => [
            'factories' => [
                'default' => 'SlmQueueSqs\Factory\SqsQueueFactory'
            ]
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
