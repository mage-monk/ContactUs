<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Plugin;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Filesystem\Io\File;
use MageMonk\ContactUs\Api\CardTypeRepositoryInterface;
use MageMonk\ContactUs\Api\QuestionRepositoryInterface;
use MageMonk\ContactUs\Framework\Mail\Template\TransportBuilder;

class TransportBuilderPlugin
{
    /**
     * @param RequestInterface $request
     * @param QuestionRepositoryInterface $questionRepository
     * @param CardTypeRepositoryInterface $cardTypeRepository
     * @param File $file
     */
    public function __construct(
        private readonly RequestInterface $request,
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly CardTypeRepositoryInterface $cardTypeRepository,
        private readonly File $file
    ) {
    }

    /**
     * Update template vars
     *
     * @param TransportBuilder $subject
     * @param array $templateVars
     * @return array
     */
    public function beforeSetTemplateVars(TransportBuilder $subject, $templateVars): array
    {
        $templateVarsData = $templateVars['data'];
        if ($cardId = $templateVarsData->getData('card')) {
            $templateVarsData->setData('card', $this->getCardTypeName($cardId));
        }
        if ($queryId = $templateVarsData->getData('query')) {
            $templateVarsData->setData('query', $this->getQueryTitle($queryId));
        }
        if ($subQueryId = $templateVarsData->getData('subquery')) {
            $templateVarsData->setData('subquery', $this->getQueryTitle($subQueryId));
        }
        $file = $this->request->getFiles('file');
        if (!empty($file['size'])) {
            $subject->addAttachment(
                $this->file->read($file['tmp_name']),
                $file['name'],
                $file['type']
            );
        }
        return [$templateVars];
    }

    /**
     * Get card type name by card type id
     *
     * @param int $cardTypeId
     * @return string
     */
    private function getCardTypeName(int $cardTypeId): string
    {
        try {
            return $this->cardTypeRepository->getById($cardTypeId)->getName();
        } catch (\Exception) {
            return '';
        }
    }

    /**
     * Get query title by query id
     *
     * @param int $queryId
     * @return string
     */
    private function getQueryTitle(int $queryId): string
    {
        try {
            return $this->questionRepository->getById($queryId)->getTitle();
        } catch (\Exception) {
            return '';
        }
    }
}
