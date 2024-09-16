<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\File\Csv;
use MageMonk\ContactUs\Api\QuestionRepositoryInterface;
use MageMonk\ContactUs\Framework\FixtureManager;
use MageMonk\ContactUs\Model\QuestionFactory;
use Magento\Framework\Filesystem\Driver\File as FileDriver;

class ContactUsPatch implements DataPatchInterface
{
    /**
     * ContactUsPatch constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param QuestionFactory $questionFactory
     * @param QuestionRepositoryInterface $questionRepository
     * @param FixtureManager $fixtureManager
     * @param Csv $csvReader
     * @param FileDriver $fileDriver
     */
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly QuestionFactory $questionFactory,
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
        $this->updateQuestion(['MageMonk_ContactUs::fixtures/question_data_updated.csv']);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * Update data to magemonk_contact_us_question tables
     *
     * @param array $fixtures
     * @return void
     */
    private function updateQuestion(array $fixtures)
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
                    if ($header[$key] == 'entity_id_id') {
                        $question->load($value);
                    }
                    $question->setData($header[$key], $value);
                }
                $question->save();
            }
        }
    }
}
