<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Api\Data;

/**
 * Question interface.
 *
 * @api
 */
interface QuestionInterface
{
    /**
     * Table column
     */
    public const ENTITY_ID = 'entity_id';
    public const CARD_TYPE_ID = 'card_type_id';
    public const PARENT_ID = 'parent_id';
    public const TITLE = 'title';
    public const STORE_ID = 'store_id';
    public const IS_ACTIVE = 'is_active';
    public const IS_NAME_MANDATORY = 'is_name_mandatory';
    public const IS_EMAIL_MANDATORY = 'is_email_mandatory';
    public const IS_TELEPHONE_MANDATORY = 'is_telephone_mandatory';
    public const IS_COMMENT_MANDATORY = 'is_comment_mandatory';
    public const IS_CARD_ID_MANDATORY = 'is_card_id_mandatory';
    public const IS_ORDER_ID_MANDATORY = 'is_order_id_mandatory';
    public const IS_POSTCODE_MANDATORY = 'is_postcode_mandatory';
    public const IS_FILE_MANDATORY = 'is_file_mandatory';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get entity id
     *
     * @return int
     */
    public function getEntityId(): int;

    /**
     * Set entity id
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId): self;

    /**
     * Get Parent id
     *
     * @return int|null
     */
    public function getParentId(): ?int;

    /**
     * Set Parent id
     *
     * @param int $parentId
     * @return $this
     */
    public function setParentId(int $parentId): self;

    /**
     * Get card type id
     *
     * @return int|null
     */
    public function getCardTypeId(): ?int;

    /**
     * Set card type id
     *
     * @param int $cardTypeId
     * @return $this
     */
    public function setCardTypeId(int $cardTypeId): self;

    /**
     * Get store id
     *
     * @return int
     */
    public function getStoreId(): int;

    /**
     * Set store id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): self;

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self;

    /**
     * Get is active
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Set is active
     *
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive(bool $isActive): self;

    /**
     * Get is fullname required
     *
     * @return bool
     */
    public function isFullNameMandatory();

    /**
     * Set is full name required
     *
     * @param bool $isFullNameMandatory
     * @return $this
     */
    public function setIsFullNameMandatory(bool $isFullNameMandatory): self;

    /**
     * Get is email required
     *
     * @return bool
     */
    public function isEmailMandatory(): bool;

    /**
     * Set is email required
     *
     * @param bool $isEmailMandatory
     * @return $this
     */
    public function setIsEmailMandatory(bool $isEmailMandatory): self;

    /**
     * Get is phone required
     *
     * @return bool
     */
    public function isPhoneMandatory(): bool;

    /**
     * Set is phone required
     *
     * @param bool $isPhoneMandatory
     * @return $this
     */
    public function setIsPhoneMandatory(bool $isPhoneMandatory): self;

    /**
     * Get is message required
     *
     * @return bool
     */
    public function isMessageMandatory(): bool;

    /**
     * Set is message required
     *
     * @param bool $isMessageMandatory
     * @return $this
     */
    public function setIsMessageMandatory(bool $isMessageMandatory): self;

    /**
     * Get is card id required
     *
     * @return bool
     */
    public function isCardIdMandatory(): bool;

    /**
     * Set is card id required
     *
     * @param bool $isCardIdMandatory
     * @return $this
     */
    public function setIsCardIdMandatory(bool $isCardIdMandatory): self;

    /**
     * Get is order id required
     *
     * @return bool
     */
    public function isOrderIdMandatory(): bool;

    /**
     * Set is order id required
     *
     * @param bool $isOrderIdMandatory
     * @return $this
     */
    public function setIsOrderIdMandatory(bool $isOrderIdMandatory): self;

    /**
     * Get is psotcode required
     *
     * @return bool
     */
    public function isPostcodedMandatory(): bool;

    /**
     * Set is psotcode required
     *
     * @param bool $isPostcodeMandatory
     * @return $this
     */
    public function setIsPostcodedMandatory(bool $isPostcodeMandatory): self;

    /**
     * Get is upload file required
     *
     * @return bool
     */
    public function isUploadFileMandatory(): bool;

    /**
     * Set is upload file required
     *
     * @param bool $isUploadFileMandatory
     * @return $this
     */
    public function setIsUploadFileMandatory(bool $isUploadFileMandatory): self;

    /**
     * Get created at time
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set created at time
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt):self;

    /**
     * Get updated at time
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Set updated at time
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): self;
}
