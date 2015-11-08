<?php
namespace Gdpro\Mailer;

use Gdpro\Mailer\SendMailCommand;
use Gdpro\Mailer\SendMailJob;
use Gdpro\Mailer\MailerLogger;
use Gdpro\Mailer\SmtpManager;
use Gdpro\Mailer\MessageRenderer;
use Gdpro\Mailer\MailerService;
use Gdpro\Mailer\Factory\SendMailCommandFactory;
use Gdpro\Mailer\Factory\SendMailJobFactory;
use Gdpro\Mailer\Factory\SmtpManagerFactory;
use Gdpro\Mailer\Factory\MessageRendererFactory;
use Gdpro\Mailer\Factory\MailerServiceFactory;
use SlmQueueSqs\Factory\SqsQueueFactory;

return [
    'console' => [
        'router' => [
            'routes' => [
                'my-first-route' => [
                    'type'    => 'simple',
                    'options' => [
                        'route'    => 'gdpro mailer send mail <templateName> <recipient> <smtpName> <vars>',
                        'defaults' => [
                            'controller' => SendMailCommand::class,
                            'action'     => 'index'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            SendMailCommand::class  => SendMailCommandFactory::class
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
        'invokables' => [
            MailerLogger::class     => MailerLogger::class
        ],
        'factories' => [
            SmtpManager::class      => SmtpManagerFactory::class,
            MessageRenderer::class  => MessageRendererFactory::class,
            MailerService::class    => MailerServiceFactory::class
        ]
    ],
    'slm_queue' => [
        'job_manager' => [
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
                'default' => SqsQueueFactory::class
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
