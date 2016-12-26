<?php
namespace GdproMailer;

use GdproMailer\Factory\Job\SendMailJobFactory;
use GdproMailer\Factory\MailerServiceFactory;
use GdproMailer\Factory\MessageRendererFactory;
use GdproMailer\Factory\SmtpManagerFactory;
use GdproMailer\Job\SendMailJob;

return [
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
            'gdpro_mailer.manager.smtp' => 'gdpro_mailer.smtp_manager',
            'gdpro_mailer.logger.mailer' => MailerLogger::class,
            'gdpro_mailer.smtp_manager' => SmtpManager::class,
            'gdpro_mailer.message_renderer' => MessageRenderer::class,
            'gdpro_mailer.mailer_service' => MailerService::class,
        ],
        'invokables' => [
            MailerLogger::class => MailerLogger::class,
        ],
        'factories' => [
            // Smtp (Transport)
            SmtpManager::class => SmtpManagerFactory::class,

            // Message
            MessageRenderer::class => MessageRendererFactory::class,

            // Service
            MailerService::class => MailerServiceFactory::class
        ]
    ],
    'slm_queue' => [
        'job_manager' => [
            'aliases' => [
                SendMailJob::class => 'gdpro_mailer.job.send_mail',
                'gdpro_mailer.job.send_mail' => SendMailJob::class
            ],

            /**
             * Allow to configure dependencies for jobs that are pulled from any queue. This works like any other
             * PluginManager in Zend Framework 2. For instance, if you want to inject something into every job using
             * a factory, just adds an element into the "factories" array, with the key being the FQCN of the job,
             * and the value the factory:
             *
             */
            'factories' => [
                SendMailJob::class => SendMailJobFactory::class
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
