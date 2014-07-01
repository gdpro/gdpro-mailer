<?php
namespace GdproMail\Mail;

use Zend\Mail\Message as MailMessage;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Message
{
    protected $config;
    protected $viewRenderer;
    protected $from;
    protected $vars;

    public function __construct($config, $viewRenderer, $from)
    {
        $this->config = $config;
        $this->viewRenderer = $viewRenderer;
        $this->from = $from;
    }

    public function getMessage()
    {
        $template = $this->config['template'];
        $content = $this->viewRenderer->render($template, $this->vars);

        $html = new MimePart($content);
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts(array($html));

        $message = new MailMessage();
        $message->setFrom($this->from);
        $message->setSubject($this->config['subject']);
        $message->setBody($body);

        return $message;
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }
}