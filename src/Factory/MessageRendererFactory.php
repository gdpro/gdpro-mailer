<?php
namespace Gdpro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MessageRendererFactory
 * @package Gdpro\Mailer\Factory
 */
class MessageRendererFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \Gdpro\Mailer\MessageRenderer(
            $config['gdpro_mailer']['templates'],
            $services->get('viewRenderer')
        );
    }
}
