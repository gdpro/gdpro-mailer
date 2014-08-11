<?php
namespace GdproMailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SmtpManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\SmtpManager(
            $config['gdpro_mailer']['smtp']
        );
    }
}
