<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Question
 */
class Question extends AbstractDb
{
    /**
     * Pre initialization
     */
    protected function _construct()
    {
        $this->_init('magemonk_contact_us_question', 'entity_id');
    }
}
