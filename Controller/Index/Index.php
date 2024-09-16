<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Controller\Result\RedirectFactory as Redirect;

use MageMonk\ContactUs\Model\ConfigInterface;

/**
 * Customer contact page
 */
class Index implements HttpGetActionInterface
{
    /**
     * Custom contact index page constructor
     *
     * @param CustomerSession $customerSession
     * @param Redirect $redirect
     * @param ConfigInterface $contactConfig
     * @param ResultFactory $resultFactory
     */
    public function __construct(
        private readonly CustomerSession $customerSession,
        private readonly Redirect $redirect,
        private readonly ConfigInterface $contactConfig,
        private readonly ResultFactory $resultFactory
    ) {
    }

    /**
     * Show customer contact page
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        if ($this->customerSession->isLoggedIn()
            && $this->contactConfig->isAccountQueryEnabled()
        ) {
            return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        }

        return $this->redirect->create()->setPath('customer/account');
    }
}
