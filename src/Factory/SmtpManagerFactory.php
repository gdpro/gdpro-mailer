<?php
namespace GdproMailer\Factory;

use Interop\Container\ContainerInterface;

class SmtpManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        /** @var array $globalConfig */
        $globalConfig = $services->get('config');
        $smtpConfig = $globalConfig['gdpro_mailer']['smtp'];

        $instance = new \GdproMailer\SmtpManager();
        $instance->setConfig($smtpConfig);

        return $instance;
    }
}
