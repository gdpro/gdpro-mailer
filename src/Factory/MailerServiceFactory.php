<?php
namespace GdproMailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MailerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\MailerService(
            $config['gdpro_mailer'],
            $services->get('gdpro_mailer.message_renderer'),
            $services->get('gdpro_mailer.smtp_manager'),
            $services->get('gdpro_monolog.manager')->get('gdpro_mailer')
        );
    }
}
