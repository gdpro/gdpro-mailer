<?php
namespace GdproMailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MessageRendererFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\MessageRenderer(
            $config['gdpro_mailer']['templates'],
            $services->get('viewRenderer')
        );
    }
}
