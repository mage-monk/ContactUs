<?php

declare(strict_types=1);

namespace MageMonk\ContactUs\Plugin;

use Magento\Contact\Controller\Index\Post;
use Magento\Framework\Controller\Result\RedirectFactory as Redirect;

/**
 * Class ChangeContactPath
 *
 * Plugin that changes contact redirect path
 */
class ChangeContactPath
{
    /**
     * @var Redirect
     */
    private $redirect;

    /**
     * ChangeContactPath constructor
     *
     * @param Redirect $redirect
     */
    public function __construct(Redirect $redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Plugin after execute
     *
     * @param Post $subject
     * @return Redirect
     */
    public function afterExecute(Post $subject)
    {
        return $this->redirect->create()->setRefererUrl();
    }
}
