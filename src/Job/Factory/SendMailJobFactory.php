<?php
namespace GdproMailer\Job\Factory;

use GdproMailer\Job\SendMailJob;
use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Interop\Container\ContainerInterface;

class SendMailJobFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $mailerService = $services->get(MailerService::class);
        $messageRenderer = $services->get(MessageRenderer::class);
        $smtpManager = $services->get(SmtpManager::class);

        $instance = new SendMailJob();
        $instance->setMailerService($mailerService);
        $instance->setMessageRenderer($messageRenderer);
        $instance->setSmtpManager($smtpManager);

        if ($services->has('gdpro_monolog.manager')) {
            $loggerManager = $services->get('gdpro_monolog.manager');
            $logger = $loggerManager->get('gdpro_mailer');
            $instance->setLogger($logger);
        }

        return $instance;
    }
}
