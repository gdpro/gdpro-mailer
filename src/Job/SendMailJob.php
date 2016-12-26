<?php
namespace GdproMailer\Job;

use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Psr\Log\LoggerInterface;
use SlmQueue\Job\AbstractJob;

/**
 * Class SendMailJob
 * @package GdproMailer\Job
 */
class SendMailJob extends AbstractJob
{
    /**
     * @var MailerService
     */
    protected $mailerService;

    /**
     * @var MessageRenderer
     */
    protected $messageRenderer;

    /**
     * @var SmtpManager
     */
    protected $smtpManager;

    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        try {
            $payload = $this->getContent();

            $templateEmail = $payload['templateEmail'];
            $vars = $payload['vars'];
            $smtpName = $payload['smtpName'];
            $recipient = $payload['recipient'];

            $message = $this->messageRenderer->render($templateEmail, $vars);
            $smtp = $this->smtpManager->get($smtpName);

            $this->mailerService->sendMessage($message, $smtp, $recipient);

            $message = 'Msg ("'.$templateEmail.'") send to '.$recipient;
            $this->logger->addInfo($message);
        } catch (\Exception $e) {
            $this->logger->addError($e->getMessage());

            throw $e;
        }
    }

    /**
     * @param MailerService $mailerService
     */
    public function setMailerService(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
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
