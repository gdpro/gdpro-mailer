<?php
namespace GdproMail\Model;

use Zend\Validator\EmailAddress;

class MailModel
{

    /**
     * @var \Zend\Mail\Message
     */
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Add a recipient
     *
     * @param string $emailAddress
     */
    public function addRecipient($emailAddress)
    {
        $this->checkAddressEmailValid($emailAddress);

        $to = $this->getEmailEntity()->getTo();
        $to[] = $emailAddress;
        $this->getEmailEntity()->setTo($to);
    }

    /**
     * Add a recipient to Bcc
     *
     * @param $emailAddress
     */
    public function addRecipientToBcc($emailAddress)
    {
        $this->checkAddressEmailValid($emailAddress);

        $bcc = $this->getEmailEntity()->getBcc();
        $bcc[] = $emailAddress;
        $this->getEmailEntity()->setBcc($bcc);
    }

    /**
     * Add Recipient to Cc
     *
     * @param $emailAddress
     */
    public function addRecipientToCc($emailAddress)
    {
        $this->checkAddressEmailValid($emailAddress);

        $cc = $this->getEmailEntity()->getCc();
        $cc[] = $emailAddress;
        $this->getEmailEntity()->setCc($cc);
    }

    /**
     * Check that address email given is valid
     *
     * @param $emailAddress
     * @throws \InvalidArgumentException
     */
    private function checkAddressEmailValid($emailAddress)
    {
        $validator = new EmailAddress();
        $isValid = $validator->isValid($emailAddress);

        if(!$isValid) {
            throw new \InvalidArgumentException(__METHOD__.' : Argument given must be a valid address email.');
        }
    }

    /**
     * Getter of Email Entity
     *
     * @return \Core\Entity\Email
     */
    public function getEmailEntity()
    {
        return $this->emailEntity;
    }
}