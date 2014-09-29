<?php
namespace GdproMailer\Command;

use GdproMailer\MailerService;
use Zend\Mvc\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Adapter\Posix;

class SendMailCommand extends AbstractActionController
{
    protected $console;
    protected $mailerService;

    public function __construct(
        Posix $console,
        MailerService $mailerService
    ) {
        $this->console = $console;
        $this->mailerService = $mailerService;
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $templateName = $this->getRequest()->getParam('templateName');
        $recipient = $this->getRequest()->getParam('recipient');
        $smtpName = $this->getRequest()->getParam('smtpName');
        $vars = $this->getRequest()->getParam('vars');


        $isSendMail = $this->mailerService->sendMail($templateName, $recipient, $smtpName, $vars);

        if($isSendMail) {
            $this->console->write('Email sent');
            return;
        }

        $this->console->write('Email not sent');
    }
}