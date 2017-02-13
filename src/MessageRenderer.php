<?php
namespace GdproMailer;

use Zend\Mail\Message;
use Zend\Mime\Message as Mime;
use Zend\Mime\Part as MimePart;
use Zend\View\Renderer\RendererInterface;

/**
 * Class MessageRenderer
 * @package GdproMailer
 */
class MessageRenderer
{
    /**
     * @var array
     */
    protected $templates;

    /**
     * @var RendererInterface
     */
    protected $mailRenderer;

    /**
     * @param $templateName
     * @param array|null $vars
     * @return Message
     * @throws \Exception
     */
    public function render($templateName, array $vars = null)
    {
        if (! array_key_exists($templateName, $this->templates)) {
            throw new \Exception(
                __METHOD__.' was unable to fetch the template named '.$templateName
            );
        }

        $templateConfig = $this->templates[$templateName];

        $content = $this->mailRenderer->render(
            $templateConfig['view'],
            $vars
        );

        $from_email = $this->templates['_default']['from_email'];
        if (isset($templateConfig['from_email'])) {
            $from_email = $templateConfig['from_email'];
        }

        $from_name = $this->templates['_default']['from_name'];
        if (isset($templateConfig['from_name'])) {
            $from_name = $templateConfig['from_name'];
        }

        $html = new MimePart($content);
        $html->type = "text/html";

        $body = new Mime();
        $body->setParts([$html]);

        $message = new Message();
        $message->setFrom($from_email, $from_name);
        $message->setSubject($templateConfig['subject']);
        $message->setBody($body);

        return $message;
    }

    /**
     * @param array $templates
     */
    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
    }

    /**
     * @param RendererInterface $mailRenderer
     */
    public function setMailRenderer(RendererInterface $mailRenderer)
    {
        $this->mailRenderer = $mailRenderer;
    }
}
