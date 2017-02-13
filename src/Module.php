<?php
namespace GdproMailer;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

/**
 * Class Module
 * @package GdproMailer
 */
class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @param Console $console
     * @return null|string
     */
    public function getConsoleBanner(Console $console)
    {
        return
            "==------------------------------------------------------==\n" .
            "GdproMailer                                               \n" .
            "==------------------------------------------------------==\n" .
            "\n";
    }

    /**
     * This method is defined in ConsoleUsageProviderInterface
     *
     * @param Console $console
     * @return array
     */
    public function getConsoleUsage(Console $console)
    {
        return [
            'Basic information:',
            'gdpro mailer send mail [templateName] [recipient] [smtpName] [vars]' =>
                'Send email',
        ];
    }
}
