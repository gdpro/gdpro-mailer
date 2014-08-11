<?php
namespace GdproMailer;

use Zend\Mail\Message;
use Zend\Mime\Message as Mime;
use Zend\Mime\Part as MimePart;
use Zend\View\Renderer\PhpRenderer as ViewRenderer;

class MessageRenderer
{
    protected $templates;
    protected $viewRenderer;

    public function __construct(array $templates, ViewRenderer $viewRenderer)
    {
        $this->templates = $templates;
        $this->viewRenderer = $viewRenderer;
    }

    public function render($templateName, array $vars)
    {
        if(!array_key_exists($templateName, $this->templates)) {
            throw new \Exception(
                __METHOD__.' was unable to fetch the template named '.$templateName
            );
        }

        $content = $this->viewRenderer->render(
            $this->templates[$templateName]['view'],
            $vars
        );

        $from_email = $this->templates['_default']['from_email'];
        if(isset($this->templates[$templateName]['from_email'])) {
            $from_email = $this->templates[$templateName]['from_email'];
        }

        $from_name = $this->templates['_default']['from_name'];
        if(isset($this->templates[$templateName]['from_name'])) {
            $from_name = $this->templates[$templateName]['from_name'];
        }

        $html = new MimePart($content);
        $html->type = "text/html";

        $body = new Mime();
        $body->setParts(array($html));

        $message = new Message();
        $message->setFrom($from_email, $from_name);
        $message->setSubject($this->templates[$templateName]['subject']);
        $message->setBody($body);

        return $message;
    }
}
