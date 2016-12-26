<?php
namespace GdproMailer\Factory;

use Interop\Container\ContainerInterface;

class MessageRendererFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\MessageRenderer(
            $config['gdpro_mailer']['templates'],
            $services->get('viewRenderer')
        );
    }
}
