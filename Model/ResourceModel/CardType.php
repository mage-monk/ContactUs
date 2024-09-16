<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model\ResourceModel;

/**
 * Class CardType
 */
class CardType extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Pre initilization
     */
    protected function _construct()
    {
        $this->_init('magemonk_contact_us_card_type', 'entity_id');
    }
}
