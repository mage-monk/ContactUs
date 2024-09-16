<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

/**
 * HTML select element block with area options
 * @method setName(string $value)
 */
class Area extends Select
{
    /**
     * Sets the input name
     *
     * @deprecated
     *
     * @param string $value Input name value
     * @return $this
     */
    public function setInputName(string $value): self
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }

        return parent::_toHtml();
    }

    /**
     * Gets options
     *
     * @return array
     */
    private function getSourceOptions(): array
    {
        return [
            [
                'label' => __('General'),
                'value' => 0
            ],
            [
                'label' => __('My Account'),
                'value' => 1
            ],
        ];
    }
}
