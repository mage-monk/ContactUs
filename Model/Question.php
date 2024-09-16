<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use MageMonk\ContactUs\Api\Data\QuestionInterface;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * Class Question
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Constant
     */
    protected const CACHE_TAG = 'magemonk_contact_us_question';

    /**
     * @var string
     */
    protected $_cacheTag = 'magemonk_contact_us_question';

    /**
     * @var string
     */
    protected $_eventPrefix = 'magmonk_contact_us_question';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\MageMonk\ContactUs\Model\ResourceModel\Question::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): int
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
    public function getCardTypeId(): ?int
    {
        return $this->_getData(self::CARD_TYPE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCardTypeId($cardTypeId): self
    {
        $this->setData(self::CARD_TYPE_ID, $cardTypeId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getParentId(): ?int
    {
        return $this->_getData(self::PARENT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setParentId($parentId): self
    {
        $this->setData(self::PARENT_ID, $parentId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return $this->_getData(self::IS_ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $isActive): self
    {
        $this->setData(self::IS_ACTIVE, $isActive);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getStoreId(): int
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
    public function getTitle(): ?string
    {
        return $this->_getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): self
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isFullNameMandatory()
    {
        return $this->_getData(self::IS_NAME_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsFullNameMandatory(bool $isFullNameMandatory): QuestionInterface|Question|static
    {
        $this->setData(self::IS_NAME_MANDATORY, $isFullNameMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isEmailMandatory(): bool
    {
        return $this->_getData(self::IS_EMAIL_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsEmailMandatory(bool $isEmailMandatory): QuestionInterface
    {
        $this->setData(self::IS_EMAIL_MANDATORY, $isEmailMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isPhoneMandatory(): bool
    {
        return $this->_getData(self::IS_TELEPHONE_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsPhoneMandatory(bool $isPhoneMandatory): QuestionInterface
    {
        $this->setData(self::IS_TELEPHONE_MANDATORY, $isPhoneMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isMessageMandatory(): bool
    {
        return $this->_getData(self::IS_COMMENT_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsMessageMandatory(bool $isMessageMandatory): QuestionInterface
    {
        $this->setData(self::IS_COMMENT_MANDATORY, $isMessageMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isCardIdMandatory(): bool
    {
        return $this->_getData(self::IS_CARD_ID_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsCardIdMandatory(bool $isCardIdMandatory): QuestionInterface
    {
        $this->setData(self::IS_CARD_ID_MANDATORY, $isCardIdMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isOrderIdMandatory(): bool
    {
        return $this->_getData(self::IS_ORDER_ID_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsOrderIdMandatory(bool $isOrderIdMandatory): QuestionInterface
    {
        $this->setData(self::IS_ORDER_ID_MANDATORY, $isOrderIdMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isPostcodedMandatory(): bool
    {
        return $this->_getData(self::IS_POSTCODE_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsPostcodedMandatory(bool $isPostcodeMandatory): QuestionInterface
    {
        $this->setData(self::IS_POSTCODE_MANDATORY, $isPostcodeMandatory);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isUploadFileMandatory(): bool
    {
        return $this->_getData(self::IS_FILE_MANDATORY);
    }

    /**
     * @inheritDoc
     */
    public function setIsUploadFileMandatory(bool $isUploadFileMandatory): QuestionInterface
    {
        $this->setData(self::IS_FILE_MANDATORY, $isUploadFileMandatory);
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
    public function setCreatedAt(string $createdAt): self
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
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
        return $this;
    }
}
