<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Block\Form;

use MageMonk\ContactUs\Block\Form;

/**
 * Class Types
 *
 * Types block for template
 */
class Types extends Form
{
    /**
     * Get contact types from admin
     *
     * @return array
     */
    public function getContactTypes(): array
    {
        $area = (string)$this->getTypeArea();
        $options = [];

        foreach ($this->contactConfig->getContactTypes() as $type) {
            if ($type['area'] === $area) {
                $options[] = $type['type'];
            }
        }

        return $options;
    }

    /**
     * Get contact types HTML
     *
     * @return string
     */
    protected function _toHtml(): string
    {
        if (!$this->isEnabled() || empty($this->getContactTypes())) {
            return '';
        }

        return parent::_toHtml();
    }
}
