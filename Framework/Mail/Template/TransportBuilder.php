<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Framework\Mail\Template;

use Laminas\Mime\Mime;

class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * @var array
     */
    private array $attachments = [];

    /**
     * Add attachment to email
     *
     * @param string $content
     * @param string $fileName
     * @param string $fileType
     * @return TransportBuilder
     */
    public function addAttachment(string $content, string $fileName, string $fileType)
    {
        $attachmentPart = new \Laminas\Mime\Part();
        $attachmentPart->setContent($content)
            ->setType($fileType)
            ->setFileName($fileName)
            ->setDisposition(Mime::DISPOSITION_ATTACHMENT)
            ->setEncoding(Mime::ENCODING_BASE64);
        $this->attachments[] = $attachmentPart;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function prepareMessage()
    {
        parent::prepareMessage();
        if (empty($this->attachments)) {
            return $this;
        }
        $body = $this->message->getBody();
        foreach ($this->attachments as $attachment) {
            $body->addPart($attachment);
        }
        $this->message->setBody($body);

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function reset()
    {
        $this->attachments = [];
        return parent::reset();
    }
}
