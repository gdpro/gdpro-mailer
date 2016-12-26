<?php
namespace GdproMailer\Factory;

use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Interop\Container\ContainerInterface;

class MailerServiceFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\MailerService(
            $config['gdpro_mailer'],
            $services->get(MessageRenderer::class),
            $services->get(SmtpManager::class),
            $services->get('gdpro_monolog.manager')->get('gdpro_mailer')
        );
    }
}
