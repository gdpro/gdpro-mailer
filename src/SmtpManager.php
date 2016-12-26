<?php
namespace GdproMailer;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

class SmtpManager
{
    protected $smtpList;

    public function __construct(array $smtpList)
    {
        $this->smtpList = $smtpList;
    }

    /**
     * @param $smtpName
     * @return Smtp
     * @throws \Exception
     */
    public function get($smtpName)
    {
        if(!array_key_exists($smtpName, $this->smtpList)) {
            throw new \Exception(
                __METHOD__.' was unable to create an instance for smtp .'.$smtpName
            );
        }

        if(!isset($this->smtpList[$smtpName]['ssl'])) {
            $this->smtpList[$smtpName]['ssl'] = 'tls';
        }

        // Create Smtp Options
        $options = new SmtpOptions([
            'name' => $this->smtpList[$smtpName]['hostname'],
            'host' => $this->smtpList[$smtpName]['host'],
            'port' => $this->smtpList[$smtpName]['port'],
            'connection_class' => 'login',
            'connection_config' => [
                'username' => $this->smtpList[$smtpName]['username'],
                'password' => $this->smtpList[$smtpName]['password'],
                'ssl' => $this->smtpList[$smtpName]['ssl']
            ]
        ]);

        // Create Smtp Transport and add options
        $smtp = new Smtp($options);

        return $smtp;
    }
}