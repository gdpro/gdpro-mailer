<?php
namespace GdproMailer\Job;

use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use Monolog\Logger;
use SlmQueue\Job\AbstractJob;
use SlmQueue\Worker\WorkerEvent;

class SendMailJob extends AbstractJob
{
    protected $mailerService;
    protected $messageRenderer;
    protected $smtpManager;
    protected $logger;

    public function __construct(
        MailerService $mailerService,
        MessageRenderer $messageRenderer,
        SmtpManager $smtpManager,
        Logger $logger
    ) {
        $this->mailerService = $mailerService;
        $this->messageRenderer = $messageRenderer;
        $this->smtpManager = $smtpManager;
        $this->logger = $logger;
    }

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

        } catch(\Exception $e) {

            $this->logger->addError($e->getMessage());

            throw $e;
        }
    }
}
