<?php
return [
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
    /* Define your templates to use with the message renderer */
    'templates' => [

        /* Replace templateName by the name of your template */
        'example' => [

            /* Define the subject of your message */
            'subject' => 'gdpro - Validation de votre inscription',

            /* Define the view template to use for the template */
            'view' => 'gdpro_mail/mail/example',
        ]
    ],

    'queue' => [
        'name'          => 'gdpro_mailer',
        'driverOptions' => [
            'host'      => '127.0.0.1',
            'port'      => '3306',
            'username'  => 'queue',
            'password'  => 'queue',
            'dbname'    => 'queue',
            'type'      => 'pdo_mysql'
        ]
    ]
];
