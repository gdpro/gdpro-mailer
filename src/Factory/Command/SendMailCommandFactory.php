<?php
namespace GdproMailer\Factory\Command;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SendMailCommandFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $services = $controllerManager->getServiceLocator();

        return new \GdproMailer\Command\SendMailCommand(
            $services->get('console'),
            $services->get('gdpro_mailer.mailer_service')
        );
    }
}
