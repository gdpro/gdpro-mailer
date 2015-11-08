<?php
namespace Gdpro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MailerServiceFactory
 * @package Gdpro\Mailer\Factory
 */
class MailerServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \Gdpro\Mailer\MailerService(
            $config['gdpro_mailer'],
            $services->get('Gdpro\\Mailer\\MessageRenderer'),
            $services->get('Gdpro\\Mailer\\SmtpManager'),
            $services->get('Gdpro\\Monolog\\LoggerManager')->get('gdpro_mailer')
        );
    }
}
