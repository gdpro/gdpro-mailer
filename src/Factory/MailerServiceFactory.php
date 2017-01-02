<?php
namespace GdproMailer\Factory;

use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Interop\Container\ContainerInterface;
use Psr\Log\NullLogger;

class MailerServiceFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');
        $config = $globalConfig['gdpro_mailer'];
        $messageRenderer = $services->get(MessageRenderer::class);
        $smtpManager = $services->get(SmtpManager::class);

        $instance = new MailerService();
        $instance->setConfig($config);
        $instance->setMessageRenderer($messageRenderer);
        $instance->setSmtpManager($smtpManager);

        if ($services->has('\\GdproMonolog\\LoggerManager')) {
            $loggerManager = $services->get('gdpro_monolog.manager');
            $logger = $loggerManager->get('gdpro_mailer');
            $instance->setLogger($logger);
        } else {
            $instance->setLogger(new NullLogger());
        }

        return $instance;
    }
}
