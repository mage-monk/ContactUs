<?php

namespace MageMonk\ContactUs\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper
{
    const XML_PATH_PREFERRED_COUNTRY = 'general/country/default';

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * Initialization
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function preferredCountry(): mixed
    {
        return $this->getConfig(self::XML_PATH_PREFERRED_COUNTRY);
    }

    /**
     * @param string $configPath
     * @return mixed
     * @throws NoSuchEntityException
     */
    protected function getConfig(string $configPath): mixed
    {
        return $this->scopeConfig->getValue($configPath, ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getId());
    }
}
