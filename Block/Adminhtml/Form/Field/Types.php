<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;


/**
 * Class Types
 */
class Types extends AbstractFieldArray
{
    /**
     * @var Area
     */
    private $areaRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     *
     * @return void
     * @throws LocalizedException
     */
    protected function _prepareToRender(): void
    {
        $this->addColumn('type', ['label' => __('Label'), 'class' => 'required-entry']);
        $this->addColumn('send_to', ['label' => __('Send Emails To')]);
        $this->addColumn('area', [
            'label' => __('Area'),
            'renderer' => $this->getAreaRenderer()
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Retrieve area column renderer
     *
     * @return Area
     * @throws LocalizedException
     */
    private function getAreaRenderer(): Area
    {
        if (!$this->areaRenderer) {
            $this->areaRenderer = $this->getLayout()->createBlock(
                Area::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->areaRenderer->setClass('area_select');
        }
        return $this->areaRenderer;
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row Object row
     * @return void
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $field = $row->getData('area');

        if ($field) {
            $name = 'option_' . $this->getAreaRenderer()->calcOptionHash($field);
            $options[$name] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }
}
