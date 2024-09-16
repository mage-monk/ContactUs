<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Plugin;

use Magento\Contact\Model\ConfigInterface;
use Magento\Framework\App\RequestInterface;

use MageMonk\ContactUs\Model\ConfigInterface as ContactConfig;

/**
 * Class ChangeRecipientEmail
 *
 * Plugin that changes recipient's email by matched enquiry type.
 */
class ChangeRecipientEmail
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ContactConfig
     */
    private $contactConfig;

    /**
     * ChangeRecipientEmail constructor.
     *
     * @param RequestInterface $request
     * @param ContactConfig $contactConfig
     */
    public function __construct(
        RequestInterface $request,
        ContactConfig $contactConfig
    ) {
        $this->request = $request;
        $this->contactConfig = $contactConfig;
    }

    /**
     * Plugin method after.
     *
     * @param ConfigInterface $subject
     * @param string $email
     * @return string
     */
    public function afterEmailRecipient(ConfigInterface $subject, string $email)
    {
        if ($this->request->getParam('type')) {
            foreach ($this->contactConfig->getContactTypes() as $type) {
                if ($type['type'] === $this->request->getParam('type')
                    && !empty($type['send_to'])
                ) {
                    $emails = [];
                    foreach (explode(',', $type['send_to']) as $value) {
                        $emails[] = trim($value);
                    }
                    $email = $emails;
                    break;
                }
            }
        }

        return $email;
    }
}
