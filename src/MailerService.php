<?php
namespace GdproMailer;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;

class MailerService
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function sendMessage(Message $message, Smtp $smtp, $recipient)
    {
        $message->addTo($recipient);

        if($this->config['email_sending_activated']) {
            $smtp->send($message);
        }
    }
}
