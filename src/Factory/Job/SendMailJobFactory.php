<?php
namespace GdproMailer\Factory\Job;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SendMailJobFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $jobPluginManager)
    {
        $services = $jobPluginManager->getServiceLocator();

        return new \GdproMailer\Job\SendMailJob(
            $services->get('gdpro_mailer.mailer_service'),
            $services->get('gdpro_mailer.message_renderer'),
            $services->get('gdpro_mailer.smtp_manager'),
            $services->get('gdpro_monolog.manager')->get('gdpro_mailer')
        );
    }
}
