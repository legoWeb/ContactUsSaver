<?php

namespace Polushkin\ContactUsSaver\Controller\Adminhtml\Index;

use Polushkin\ContactUsSaver\Controller\Adminhtml\ContactUsSaver;

class Edit extends ContactUsSaver
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Polushkin_ContactUsSaver::contact_enquiries')
            ->addBreadcrumb(__('Enquiries'), __('Enquiries'))
            ->addBreadcrumb(__('Manage Enquiries'), __('Manage Enquiries'));

        $resultPage->addBreadcrumb(
            __('Enquiry'),
            __(sprintf('Enquiry: #%s', $this->getRequest()->getParam('enquiry_id')))
        );
        $resultPage->getConfig()->getTitle()->prepend(
            __(sprintf('Enquiry: #%s', $this->getRequest()->getParam('enquiry_id')))
        );

        return $resultPage;
    }
}
