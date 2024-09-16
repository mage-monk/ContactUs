<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Model;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * Set types config path
     */
    public const XML_TYPES_ENABLED = 'contact/contact/enquiry_enabled';

    /**
     * Set types path
     *
     * @var string
     */
    public const XML_TYPES = 'contact/contact/types';

    /**
     * Set account query config path
     */
    public const XML_ACCOUNT_QUERY_ENABLED = 'contact/contact/account_query_enabled';

    /**
     * Set area general
     *
     * @var int
     */
    public const AREA_GENERAL = 0;

    /**
     * Set area account
     *
     * @var int
     */
    public const AREA_ACCOUNT = 1;

    /**
     * Get contact types from admin
     *
     * @return bool
     */
    public function isEnabled(): bool;

    /**
     * Get contact types from admin
     *
     * @return array
     */
    public function getContactTypes(): array;

    /**
     * Checks if account query is enabled
     *
     * @return bool
     */
    public function isAccountQueryEnabled(): bool;
}
