<?php
namespace Gdopro\Mailer\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MyControllerFactory
 * @package Gdopro\Mailer\Factory
 */
class MyControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sl)
    {
        $queueManager = $sl->get('SlmQueue\\Queue\\QueuePluginManager');
        $queue        = $queueManager->get('default');
        $controller   = new MyController($queue);

        return $controller;
    }
}