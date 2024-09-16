<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MageMonk\ContactUs\Api\Data\CardTypeInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Exception;

interface CardTypeRepositoryInterface
{
    /**
     * Get by id
     *
     * @param int $entityId
     * @return CardTypeInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId): CardTypeInterface;

    /**
     * Save
     *
     * @param CardTypeInterface $cardType
     * @return CardTypeInterface
     * @throws AlreadyExistsException
     */
    public function save(CardTypeInterface $cardType): CardTypeInterface;

    /**
     * Delete
     *
     * @param CardTypeInterface $cardType
     * @return void
     * @throws Exception
     */
    public function delete(CardTypeInterface $cardType): void;
}
