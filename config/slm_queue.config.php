<?php
return [
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
        ],
    ],

    /**
     * Worker Strategies
     */
    'worker_strategies' => [
        'queues' => [ // per queue
            'default' => [
                'gdpro_mailer.strategy.max_polling_frequency_strategy' => [
                    'MaxFrequency' => 0.05 // Max polling per second
                ]
            ]
        ]
    ],

    /**
     * Strategy manager configuration
     */
    'strategy_manager' => [
        'invokables' => [
            'gdpro_mailer.strategy.max_polling_frequency_strategy' => 'GdproMailer\Strategy\MaxPollingFrequencyStrategy',
        ]
    ]
];
