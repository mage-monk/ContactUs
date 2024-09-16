<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Contact module configuration
 */
class Config implements ConfigInterface
{
    /**
     * Magento scope configuration
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Magento manager configuration
     *
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Json handler
     *
     * @var Json
     */
    private $json;

    /**
     * Configuration constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param Json $json
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Json $json
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->json = $json;
    }

    /**
     * Gets store ID
     *
     * @return string
     */
    private function getStoreId(): string
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Get contact types from admin
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_TYPES_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }

    /**
     * Get contact types from admin
     *
     * @return array
     */
    public function getContactTypes(): array
    {
        $config = $this->scopeConfig->getValue(
            self::XML_TYPES,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );

        return $this->json->unserialize($config);
    }

    /**
     * Checks if account query is enabled
     *
     * @return bool
     */
    public function isAccountQueryEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_ACCOUNT_QUERY_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }
}
