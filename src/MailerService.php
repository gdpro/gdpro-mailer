<?php
namespace GdproMailer;

use Psr\Log\LoggerInterface;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;

/**
 * Class MailerService
 * @package GdproMailer
 */
class MailerService
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var MessageRenderer
     */
    protected $messageRenderer;

    /**
     * @var SmtpManager
     */
    protected $smtpManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param Message $message
     * @param Smtp $smtp
     * @param $recipient
     */
    public function sendMessage(Message $message, Smtp $smtp, $recipient)
    {
        $message->addTo($recipient);

        if (! $this->config['disable_delivery']) {
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

        if ($isDisableDelivery) {
            $this->logger->addInfo('');
            return;
        }

        $message = $this->messageRenderer->render($templateName, $vars);
        $message->addTo($recipient);

        $smtp = $this->smtpManager->get($smtpName);

        try {
            $smtp->send($message);

            $this->logger->addInfo('');
        } catch (\Exception $e) {
            $this->logger->warn($e->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param MessageRenderer $messageRenderer
     */
    public function setMessageRenderer(MessageRenderer $messageRenderer)
    {
        $this->messageRenderer = $messageRenderer;
    }

    /**
     * @param SmtpManager $smtpManager
     */
    public function setSmtpManager(SmtpManager $smtpManager)
    {
        $this->smtpManager = $smtpManager;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
