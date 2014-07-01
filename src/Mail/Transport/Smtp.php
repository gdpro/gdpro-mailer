<?php
namespace GdproMail\Mail\Transport;

use Zend\Mail\Transport\Smtp as TransportSmtp;
use Zend\Mail\Transport\SmtpOptions;

class Smtp
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getSmtp()
    {
        // Create Smtp Options
        $options = new SmtpOptions([
            'name' => $this->config['name'],
            'host' => $this->config['host'],
            'connection_class' => 'login',
            'connection_config' => [
                'username' => $this->config['username'],
                'password' => $this->config['password'],
                'ssl' => 'tls'
            ]
        ]);

        // Create Smtp Transport and add options
        $smtp = new TransportSmtp($options);

        return $smtp;
    }
}