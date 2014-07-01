<?php
Namespace GdproMail\Service;

class MailService
{
    protected $smtp;
    protected $message;

    protected $recipients;

    public function __construct($smtp, $message)
    {
        $this->smtp = $smtp;
        $this->message = $message;
    }

    public function sendMessage()
    {
        $message = $this->message->getMessage();
        $message->addTo($this->recipients);

        $smtp = $this->smtp->getSmtp();
        $smtp->send($message);
    }

    public function setVars($vars)
    {
        $this->message->setVars($vars);
    }

    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    protected function getRecipients()
    {

    }
}