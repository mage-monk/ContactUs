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
use MageMonk\ContactUs\Setup\Patch\Data\ContactUsPatch;

class MandatoryFieldsPatch implements DataPatchInterface
{
    /**
     * MandatoryFieldsPatch constructor
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
        $this->updateMandatory(['MageMonk_ContactUs::fixtures/update_mandetory_field.csv']);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [
            ContactUsPatch::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Update data to magemonk_contact_us_question tables
     *
     * @param array $fixtures
     * @return void
     */
    private function updateMandatory(array $fixtures): void
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
                    if ($header[$key] == 'entity_id') {
                        $question->load($value);
                    }

                    $question->setData($header[$key], $value);
                }
                $question->save();
            }
        }
    }
}
