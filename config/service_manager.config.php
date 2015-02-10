<?php
return [
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
];