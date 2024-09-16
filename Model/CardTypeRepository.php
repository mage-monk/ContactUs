<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use MageMonk\ContactUs\Api\Data\CardTypeInterface;
use MageMonk\ContactUs\Api\Data\CardTypeInterfaceFactory;
use MageMonk\ContactUs\Api\CardTypeRepositoryInterface;
use MageMonk\ContactUs\Model\ResourceModel\CardType as ResourceModel;

/**
 * Class CardTypeRepository
 */
class CardTypeRepository implements CardTypeRepositoryInterface
{
    /**
     * Initilization
     *
     * @param CardTypeInterfaceFactory $cardTypeFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        private readonly CardTypeInterfaceFactory $cardTypeFactory,
        private readonly ResourceModel $resourceModel
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getById($entityId): CardTypeInterface
    {
        $cardType = $this->cardTypeFactory->create();
        $this->resourceModel->load($cardType, $entityId);
        if (!$cardType->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find card type with ID "%1"', $entityId));
        }
        return $cardType;
    }

    /**
     * @inheritDoc
     */
    public function save(CardTypeInterface $cardType): CardTypeInterface
    {
        $this->resourceModel->save($cardType);
        return $cardType;
    }

    /**
     * @inheritDoc
     */
    public function delete(CardTypeInterface $cardType): void
    {
        $this->resourceModel->delete($cardType);
    }
}
