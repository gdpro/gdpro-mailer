<?php
namespace GdproMailer\Job;

use GdproMailer\MailerService;
use GdproMailer\MessageRenderer;
use GdproMailer\SmtpManager;
use SlmQueue\Job\AbstractJob;

class SendMailJob extends AbstractJob
{
    public function __construct(
        MailerService $mailerService,
        MessageRenderer $messageRenderer,
        SmtpManager $smtpManager
    ) {
        $this->mailerService = $mailerService;
        $this->messageRenderer = $messageRenderer;
        $this->smtpManager = $smtpManager;
    }

    public function execute()
    {
        $payload = $this->getContent();

        $templateEmail = $payload['templateEmail'];
        $vars = $payload['vars'];
        $smtpName = $payload['smtpName'];
        $recipient = $payload['recipient'];

        $message = $this->messageRenderer->render($templateEmail, $vars);
        $smtp = $this->smtpManager->get($smtpName);

        $this->mailerService->sendMessage($message, $smtp, $recipient);
    }
}