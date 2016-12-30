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
        $templates = $globalConfig['view_manager']['template_map'];
        $viewRenderer = $container->get('viewRenderer');

        $instance = new \GdproMailer\MessageRenderer();
        $instance->setTemplates($templates);
        $instance->setViewRenderer($viewRenderer);

        return $instance;
    }
}
