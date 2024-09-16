<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Block;

use Magento\Contact\Block\ContactForm;
use Magento\Framework\View\Element\Template;

use MageMonk\ContactUs\Model\ConfigInterface;

/**
 * Class Form
 *
 * Main contact form block
 */
class Form extends ContactForm
{
    /**
     * Initialization
     *
     * @param Template\Context $context
     * @param ConfigInterface $contactConfig
     * @param array $data
     */
    public function __construct(
        Template\Context                   $context,
        protected readonly ConfigInterface $contactConfig,
        array                              $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get contact types from admin
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->contactConfig->isEnabled();
    }
}
