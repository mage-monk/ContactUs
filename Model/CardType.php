<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;
use MageMonk\ContactUs\Api\Data\CardTypeInterface;

/**
 * Class CardType
 */
class CardType extends AbstractModel implements CardTypeInterface
{
    /**
     * Constant
     */
    protected const CACHE_TAG = 'magemonk_contact_us_card_type';

    /**
     * @var string
     */
    protected $_cacheTag = 'magemonk_contact_us_card_type';

    /**
     * @var string
     */
    protected $_eventPrefix = 'magemonk_contact_us_card_type';

    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\CardType::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): ?int
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId): self
    {
        $this->setData(self::ENTITY_ID, $entityId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreId(): ?int
    {
        return $this->_getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId($storeId): self
    {
        $this->setData(self::STORE_ID, $storeId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIsActive(): ?int
    {
        return $this->_getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive($isActive): self
    {
        $this->setData(self::IS_ACTIVE, $isActive);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($title): self
    {
        $this->setData(self::NAME, $title);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->_getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt): self
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt): self
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }
}
