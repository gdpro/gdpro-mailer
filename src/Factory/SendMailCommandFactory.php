<?php
namespace Gdpro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SendMailCommandFactory
 * @package Gdpro\Mailer\Factory
 */
class SendMailCommandFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $jobPluginManager)
    {
        $services = $jobPluginManager->getServiceLocator();

        return new \Gdpro\Mailer\SendMailCommand(
        );
    }
}
