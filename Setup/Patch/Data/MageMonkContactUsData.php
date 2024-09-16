<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Setup\Patch\Data;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\File\Csv;
use MageMonk\ContactUs\Api\CardTypeRepositoryInterface;
use MageMonk\ContactUs\Api\QuestionRepositoryInterface;
use MageMonk\ContactUs\Framework\FixtureManager;
use MageMonk\ContactUs\Model\CardTypeFactory;
use MageMonk\ContactUs\Model\QuestionFactory;
use Magento\Framework\Filesystem\Driver\File as FileDriver;

class MageMonkContactUsData implements DataPatchInterface
{
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CardTypeFactory $cardTypeFactory
     * @param QuestionFactory $questionFactory
     * @param CardTypeRepositoryInterface $cardTypeRepository
     * @param QuestionRepositoryInterface $questionRepository
     * @param FixtureManager $fixtureManager
     * @param Csv $csvReader
     * @param FileDriver $fileDriver
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly CardTypeFactory $cardTypeFactory,
        private readonly QuestionFactory $questionFactory,
        private readonly CardTypeRepositoryInterface $cardTypeRepository,
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly FixtureManager $fixtureManager,
        private readonly Csv $csvReader,
        private readonly FileDriver $fileDriver
    ) {
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->installCardType(['MageMonk_ContactUs::fixtures/cardtype_data.csv']);
        $this->installQuestion(['MageMonk_ContactUs::fixtures/question_data.csv']);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Install data to magemonk_contact_us_card_type tables
     *
     * @param array $fixtures
     * @return void
     * @throws FileSystemException
     * @throws LocalizedException
     */
    private function installCardType(array $fixtures): void
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!$this->fileDriver->isExists($fileName)) {
                continue;
            }

            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $cardType = $this->cardTypeFactory->create();
                foreach ($row as $key => $value) {
                    $cardType->setData($header[$key], $value);
                }
                $this->cardTypeRepository->save($cardType);
            }
        }
    }

    /**
     * Install data to magemonk_contact_us_question tables
     *
     * @param array $fixtures
     * @return void
     * @throws FileSystemException
     * @throws LocalizedException
     */
    private function installQuestion(array $fixtures)
    {
        foreach ($fixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!$this->fileDriver->isExists($fileName)) {
                continue;
            }
            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            foreach ($rows as $row) {
                $question = $this->questionFactory->create();
                foreach ($row as $key => $value) {
                    $question->setData($header[$key], $value);
                }
                $this->questionRepository->save($question);
            }
        }
    }
}
