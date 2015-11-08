<?php
namespace Gdpro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SmtpManagerFactory
 * @package Gdpro\Mailer\Factory
 */
class SmtpManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \Gdpro\Mailer\SmtpManager(
            $config['gdpro_mailer']['smtp']
        );
    }
}
