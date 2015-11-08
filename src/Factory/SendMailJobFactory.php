<?php
namespace Gdpro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SendMailJobFactory
 * @package Gdpro\Mailer\Factory
 */
class SendMailJobFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $jobPluginManager)
    {
        $services = $jobPluginManager->getServiceLocator();

        return new \Gdpro\Mailer\SendMailJob(
            $services->get('Gdpro\\Mailer\\MailerService'),
            $services->get('Gdpro\\Mailer\\MessageRenderer'),
            $services->get('Gdpro\\Mailer\\SmtpManager'),
            $services->get('Gdpro\\Monolog\\LoggerManager')->get('gdpro_mailer')
        );
    }
}
