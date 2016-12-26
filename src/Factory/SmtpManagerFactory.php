<?php
namespace GdproMailer\Factory;

use Interop\Container\ContainerInterface;

class SmtpManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMailer\SmtpManager(
            $config['gdpro_mailer']['smtp']
        );
    }
}
