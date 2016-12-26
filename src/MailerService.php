<?php
namespace GdproMailer;

use GdproMailer\Logger\Log\Creator\MailerLogCreator;
use Monolog\Logger;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;

/**
 * Class MailerService
 * @package GdproMailer
 */
class MailerService
{
    protected $config;
    protected $messageRenderer;
    protected $smtpManager;
    protected $logger;

    public function __construct(
        array $config,
        MessageRenderer $messageRenderer,
        SmtpManager $smtpManager,
        Logger $logger
    ) {
        $this->config = $config;
        $this->messageRenderer = $messageRenderer;
        $this->smtpManager = $smtpManager;
        $this->logger = $logger;
    }

    /**
     * @param Message $message
     * @param Smtp $smtp
     * @param $recipient
     */
    public function sendMessage(Message $message, Smtp $smtp, $recipient)
    {
        $message->addTo($recipient);

        if(!$this->config['disable_delivery']) {
            $smtp->send($message);
        }
    }

    /**
     * @param $templateName
     * @param $recipient
     * @param string $smtpName
     * @param array|null $vars
     * @return bool|void
     */
    public function sendMail(
        $templateName,
        $recipient,
        $smtpName = 'default',
        array $vars = null
    ) {
        $isDisableDelivery = $this->config['disable_delivery'];

        $log = $this->mailerLogCreator->createLog($templateName,
            $recipient, $smtpName, $isDisableDelivery);

        if($isDisableDelivery) {
            $this->logger->addInfo($log);
            return;
        }

        $message = $this->messageRenderer->render($templateName, $vars);
        $message->addTo($recipient);

        $smtp = $this->smtpManager->get($smtpName);

        try {
            $smtp->send($message);

            $this->logger->addInfo($log);

        } catch(\Exception $e) {
            $this->logger->warn($e->getMessage());
            return false;
        }

        return true;
    }
}
