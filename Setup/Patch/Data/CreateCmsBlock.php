<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Setup\Patch\Data;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Cms\Api\Data\BlockInterfaceFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateCmsBlock implements DataPatchInterface
{
    private BlockInterfaceFactory $blockFactory;
    private BlockRepositoryInterface $blockRepository;

    /**
     * @param BlockInterfaceFactory $blockFactory
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(
        BlockInterfaceFactory $blockFactory,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $cmsBlockContent = <<<HTML
<div class="contact-faqs">
    <legend class="legend"><span>Check our FAQs</span></legend><br />
    <div class="field note no-label">
        You might find answers to your questions under our <a href="apex-faqs">FAQs</a>
    </div>
</div>
HTML;
        $cmsBlockData = [
            'title' => 'Contact Us content right',
            'identifier' => 'contact-us-content-right',
            'content' => $cmsBlockContent,
            'is_active' => 1,
            'stores' => 0
        ];

        /** @var BlockInterface $cmsBlock */
        $cmsBlock = $this->blockFactory->create(['data' => $cmsBlockData]);
        $this->blockRepository->save($cmsBlock);
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }
}
