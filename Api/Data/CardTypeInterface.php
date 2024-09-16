<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Api\Data;

/**
 * CardType interface.
 *
 * @api
 */
interface CardTypeInterface
{
    /**
     * Constants for database table columns
     */
    public const ENTITY_ID = 'entity_id';
    public const STORE_ID = 'store_id';
    public const IS_ACTIVE = 'is_active';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get Card Type id
     *
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * Set Card Type id
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId): self;

    /**
     * Get store id
     *
     * @return int|null
     */
    public function getStoreId(): ?int;

    /**
     * Set store id
     *
     * @param  int $storeId
     * @return $this
     */
    public function setStoreId($storeId): self;

    /**
     * Get is active id
     *
     * @return int|null
     */
    public function getIsActive(): ?int;

    /**
     * Set is active
     *
     * @param int $isActive
     * @return $this
     */
    public function setIsActive(int $isActive): self;

    /**
     * Get title
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setName(string $title): self;

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
    public function setCreatedAt(string $createdAt): self;

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
