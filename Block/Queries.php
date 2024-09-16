<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Block;

use Magento\Framework\View\Element\Template;
use MageMonk\ContactUs\Model\Config;
use MageMonk\ContactUs\Api\Data\CardTypeInterface;
use MageMonk\ContactUs\Model\ResourceModel\CardType\Collection as CardTypeCollection;
use MageMonk\ContactUs\Model\ResourceModel\CardType\CollectionFactory as CardTypeCollectionFactory;
use MageMonk\ContactUs\Model\ResourceModel\Question\Collection as QuestionCollection;
use MageMonk\ContactUs\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

class Queries extends Template
{
    /**
     * @var string
     */
    protected $_template = 'MageMonk_ContactUs::form/queries.phtml';

    private QuestionCollection $questionCollection;

    /**
     * @var CardTypeCollection
     */
    private CardTypeCollection $cardTypeCollection;

    /**
     * @var string[]
     */
    private array $queriesFrontendFields = [
        'entity_id',
        'parent_id',
        'title',
        'children',
        'card_type_id',
    ];

    /**
     * @var array
     */
    private array $defaultFieldsConfiguration = [
        'is_name_mandatory' => true,
        'is_email_mandatory' => true,
        'is_telephone_mandatory' => true,
        'is_comment_mandatory' => true,
        'is_card_id_mandatory' => false,
        'is_order_id_mandatory' => false,
        'is_postcode_mandatory' => false,
        'is_file_mandatory' => false
    ];

    /**
     * @var string[]
     */
    private array $cardTypeFrontendFields = [
        'entity_id',
        'name'
    ];

    /**
     * Initialization
     *
     * @param Template\Context $context
     * @param CardTypeCollectionFactory $cardTypeCollectionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param Config $config
     * @param array $data
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function __construct(
        Template\Context $context,
        private readonly CardTypeCollectionFactory $cardTypeCollectionFactory,
        private readonly QuestionCollectionFactory $questionCollectionFactory,
        private readonly Config $config,
        array $data = []
    ) {
        $this->cardTypeCollection = $cardTypeCollectionFactory->create();
        $this->questionCollection = $questionCollectionFactory->create();
        $storeId = $context->getStoreManager()->getStore()->getId();
        $this->cardTypeCollection->addStoreFilter((int)$storeId);
        $this->questionCollection->addStoreFilter((int)$storeId);
        $this->queriesFrontendFields = array_merge(
            $this->queriesFrontendFields,
            array_keys($this->defaultFieldsConfiguration)
        );
        parent::__construct($context, $data);
    }

    /**
     * Return card types
     *
     * @return CardTypeInterface[]
     */
    public function getCardTypes(): array
    {
        return $this->cardTypeCollection->getItems();
    }

    /**
     * @inheritDoc
     */
    public function getJsLayout(): false|string
    {
        return json_encode([
            'cardTypes' => $this->cardTypeCollection->toArray($this->cardTypeFrontendFields),
            'queries' => $this->questionCollection->toArray($this->queriesFrontendFields),
            'defaultFieldsConfiguration' => $this->defaultFieldsConfiguration
        ]);
    }

    /**
     * @inheritDoc
     */
    public function toHtml(): string
    {
        if ($this->config->isEnabled()) {
            return parent::toHtml();
        }

        return '';
    }
}
