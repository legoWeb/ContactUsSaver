<?php

namespace Polushkin\ContactUsSaver\Controller\Adminhtml\Index;

use Polushkin\ContactUsSaver\Controller\Adminhtml\ContactUsSaver;

class Index extends ContactUsSaver
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Polushkin_ContactUsSaver::contact_enquiries');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Form Enquiries'));
        $resultPage->addBreadcrumb(__('Contact Form Enquiries'), __('Contact Form Enquiries'));
        return $resultPage;
    }
}
