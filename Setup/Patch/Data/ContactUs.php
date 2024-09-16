<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Setup\Patch\Data;

use Magento\Cms\Model\Page;
use Magento\Framework\App\Filesystem\DirectoryList as AppDirectoryList;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File as FileDriver;
use Magento\Framework\Filesystem\Glob;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Cms\Model\GetPageByIdentifier;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ContactUs
 * Responsible to create default English Website CMS Pages
 */
class ContactUs implements DataPatchInterface
{
    /**
     * Constant for Swiss English Store
     */
    private const DEFAULT = 'en_us';

    /**
     * CreatContactUSCmsPages Initialization
     *
     * @param DirectoryList $dirList
     * @param FileDriver $fileDriver
     * @param PageRepositoryInterface $pageRepository
     * @param PageFactory $pageFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     * @param GetPageByIdentifier $getPageByIdentifier
     */
    public function __construct(
        private readonly DirectoryList $dirList,
        private readonly FileDriver $fileDriver,
        private readonly PageRepositoryInterface $pageRepository,
        private readonly PageFactory $pageFactory,
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly StoreManagerInterface $storeManager,
        private readonly LoggerInterface $logger,
        private readonly GetPageByIdentifier $getPageByIdentifier
    ) {
    }

    /**
     * Create Swiss English Website CMS Pages
     *
     * @return void
     * @throws LocalizedException
     */
    public function apply(): void
    {
        $this->moduleDataSetup->startSetup();
        $appDirPath = $this->dirList->getPath(AppDirectoryList::APP);
        $htmlEnglishFiles = Glob::glob(
            $appDirPath .'/code/MageMonk/ContactUS/view/web/template/cms/pages/default/english/*.html'
        );

        // Get store ID by store code
//        $storeId = (int) $this->storeManager->getStore(self::DEFAULT)->getId();
        $storeId = 0;
        foreach ($htmlEnglishFiles as $htmlFile) {
            if (!$this->fileDriver->isExists($htmlFile)) {
                continue;
            }
            // phpcs:disable Generic.Files.LineLength.TooLong
            $htmlFileContent = $this->fileDriver->fileGetContents($htmlFile);
            $htmlFile = basename($htmlFile);

            $pageData = [];

            if ($htmlFile === 'contact-us.html') {
                $pageData = [
                    'title' => 'Contact Us',
                    'page_layout' => '1column',
                    'meta_keywords' => 'MageMonk Contact Us, contact us, query, queries, question, Q&A',
                    'meta_description' => 'MageMonk Contact Us',
                    'identifier' => 'contact-us',
                    'content' => $htmlFileContent,
                    'is_active' => 1,
                    'meta_title' => 'MageMonk Contact Us',
                ];
            }

            try {
                $this->getPageByIdentifier->execute($pageData['identifier'], $storeId);
            } catch (\Exception $e) {
                $page = $this->pageFactory->create();
                $page->setIdentifier($pageData['identifier']);
                $page->setStoreId($storeId);
                $page->setTitle($pageData['title']);
                $page->setPageLayout($pageData['page_layout']);
                $page->setMetaKeywords($pageData['meta_keywords']);
                $page->setMetaDescription($pageData['meta_description']);
                $page->setContent($pageData['content']);
                $page->setIsActive($pageData['is_active']);
                $page->setMetaTitle($pageData['meta_title']);
                $this->createPage($page);
                $this->logger->critical($e);
            }
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * Create page data
     *
     * @param Page $page
     * @return void
     */
    private function createPage(Page $page): void
    {
        try {
            $this->pageRepository->save($page);
        } catch (LocalizedException $e) {
            $this->logger->critical($e);
        }
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
