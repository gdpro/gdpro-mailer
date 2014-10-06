<?php
return [
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
];
