<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

use Exception as ExceptionAlias;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use MageMonk\ContactUs\Api\Data\QuestionInterface;
use MageMonk\ContactUs\Api\Data\QuestionInterfaceFactory;
use MageMonk\ContactUs\Api\QuestionRepositoryInterface;
use MageMonk\ContactUs\Model\ResourceModel\Question as ResourceModel;

/**
 * Class QuestionRepository
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @param QuestionInterfaceFactory $questionFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        private readonly QuestionInterfaceFactory $questionFactory,
        private readonly ResourceModel $resourceModel
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getById($entityId): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->resourceModel->load($question, $entityId);
        if (!$question->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find card type with ID "%1"', $entityId));
        }
        return $question;
    }

    /**
     * @inheritDoc
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
        $this->resourceModel->save($question);
        return $question;
    }

    /**
     * @inheritDoc
     * @throws ExceptionAlias
     */
    public function delete(QuestionInterface $question): void
    {
        $this->resourceModel->delete($question);
    }
}
