<?php
namespace GdproMailer;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

/**
 * Class SmtpManager
 * @package GdproMailer
 */
class SmtpManager
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param $smtpName
     * @return Smtp
     * @throws \Exception
     */
    public function get($smtpName)
    {
        if (! array_key_exists($smtpName, $this->config)) {
            throw new \Exception(
                __METHOD__.' was unable to create an instance for smtp .'.$smtpName
            );
        }

        if (! isset($this->config[$smtpName]['ssl'])) {
            $this->config[$smtpName]['ssl'] = 'tls';
        }

        // Create Smtp Options
        $options = new SmtpOptions([
            'name' => $this->config[$smtpName]['name'],
            'host' => $this->config[$smtpName]['host'],
            'port' => $this->config[$smtpName]['port'],
            'connection_class' => 'login',
            'connection_config' => [
                'username' => $this->config[$smtpName]['username'],
                'password' => $this->config[$smtpName]['password'],
                'ssl' => $this->config[$smtpName]['ssl']
            ]
        ]);

        // Create Smtp Transport and add options
        $smtp = new Smtp($options);

        return $smtp;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }
}
