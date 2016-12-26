<?php
namespace GdproMailer\Factory\Job;

use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Interop\Container\ContainerInterface;

class SendMailJobFactory
{
    public function __invoke(ContainerInterface $jobPluginManager)
    {
        $services = $jobPluginManager->getServiceLocator();

        return new \GdproMailer\Job\SendMailJob(
            $services->get(MailerService::class),
            $services->get(MessageRenderer::class),
            $services->get(SmtpManager::class),
            $services->get('gdpro_monolog.manager')->get('gdpro_mailer')
        );
    }
}
