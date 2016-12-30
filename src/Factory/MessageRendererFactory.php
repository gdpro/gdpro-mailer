<?php
namespace GdproMailer\Factory;

use Interop\Container\ContainerInterface;
use Zend\View\Renderer\PhpRenderer;

class MessageRendererFactory
{
    public function __invoke(ContainerInterface $container)
    {
        /** @var array $globalConfig */
        /** @var PhpRenderer $viewRenderer */

        $globalConfig = $container->get('config');
        $templates = $globalConfig['gdpro_mailer']['templates'];
        $mailRenderer = $container->get('MailRenderer');

        $instance = new \GdproMailer\MessageRenderer();
        $instance->setTemplates($templates);
        $instance->setMailRenderer($mailRenderer);

        return $instance;
    }
}
