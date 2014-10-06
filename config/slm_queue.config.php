<?php
return [
    'job_manager' => [
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
        ],
    ]
];
