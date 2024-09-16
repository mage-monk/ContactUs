<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Api;

use MageMonk\ContactUs\Api\Data\QuestionInterface;
use Magento\Framework\Exception\NoSuchEntityException;

interface QuestionRepositoryInterface
{
    /**
     * Get by id
     *
     * @param int $entityId
     * @return Data\QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $entityId): QuestionInterface;

    /**
     * Save
     *
     * @param QuestionInterface $question
     * @return Data\QuestionInterface
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * Delete
     *
     * @param Data\QuestionInterface $question
     * @return void
     */
    public function delete(QuestionInterface $question): void;
}
