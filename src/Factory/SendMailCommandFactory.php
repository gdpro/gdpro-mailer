<?php
namespace Gdpro\Mailer\Factory;

use Interop\Container\ContainerInterface;

class SendMailCommandFactory
{
    public function __invoke(ContainerInterface $jobPluginManager)
    {
        $services = $jobPluginManager->getServiceLocator();

        return new \Gdpro\Mailer\SendMailCommand(
        );
    }
}
