<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model\ResourceModel\Question;

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
    protected $_eventPrefix = 'magemonk_contact_us_question';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \MageMonk\ContactUs\Model\Question::class,
            \MageMonk\ContactUs\Model\ResourceModel\Question::class
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
     * @param string $storeId
     * @return $this
     */
    public function addStoreFilter($storeId): self
    {
        $this->addFieldToFilter('main_table.store_id', ['in' => [0, $storeId]]);
        return $this;
    }

    /**
     * Add is Active filter
     *
     * @return $this
     */
    public function addIsActiveFilter()
    {
        $this->addFieldToFilter('main_table.is_active', 1);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function _afterLoad()
    {
        parent::_afterLoad();

        $parentItems = $this->getItemsByColumnValue('parent_id', 0);
        foreach ($parentItems as $parentItem) {
            $parentItem->setData('children', $this->getItemsByColumnValue('parent_id', $parentItem->getId()));
        }

        $this->_items = $parentItems;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray($arrRequiredFields = []): array
    {
        $array =  parent::toArray($arrRequiredFields);
        foreach ($array['items'] as &$item) {
            foreach (($item['children'] ?? []) as $key => $child) {
                $item['children'][$key] = $child->toArray($arrRequiredFields);
            }
        }

        return $array;
    }
}
