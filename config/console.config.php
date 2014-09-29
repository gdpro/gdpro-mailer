<?php
return [
    'router' => [
        'routes' => [
            'my-first-route' => [
                'type'    => 'simple',
                'options' => [
                    'route'    => 'gdpro mailer send mail <templateName> <recipient> <smtpName> <vars>',
                    'defaults' => [
                        'controller' => 'GdproMailer\Command\SendMail',
                        'action'     => 'index'
                    ]
                ]
            ]
        ]
    ]
];
