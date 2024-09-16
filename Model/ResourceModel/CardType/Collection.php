<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model\ResourceModel\CardType;

/**
 * Class Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'magemonk_contact_us_card_type';

    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init(
            \MageMonk\ContactUs\Model\CardType::class,
            \MageMonk\ContactUs\Model\ResourceModel\CardType::class
        );
    }

    /**
     * @inheritDoc
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addIsActiveFilter();
        return $this;
    }

    /**
     * Add store filter
     *
     * @param int $storeId
     * @return $this
     */
    public function addStoreFilter(int $storeId): self
    {
        $this->addFieldToFilter('main_table.store_id', ['in' => [0, $storeId]]);

        return $this;
    }

    /**
     * Add is Active filter
     *
     * @return $this
     */
    public function addIsActiveFilter(): self
    {
        $this->addFieldToFilter('main_table.is_active', 1);
        return $this;
    }
}
