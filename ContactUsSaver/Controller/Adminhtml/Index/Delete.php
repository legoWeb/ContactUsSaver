<?php

namespace Polushkin\ContactUsSaver\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Polushkin\ContactUsSaver\Controller\Adminhtml\ContactUsSaver;

class Delete extends ContactUsSaver
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $enquiryId = $this->getRequest()->getParam('enquiry_id');
        if ($enquiryId) {
            try {
                $this->enquiryRepository->deleteById($enquiryId);
                $this->messageManager->addSuccessMessage(__('The enquiry has been deleted.'));
                $resultRedirect->setPath('contactussaver/index');
                return $resultRedirect;
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('The enquiry no longer exists.'));
                return $resultRedirect->setPath('contactussaver/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('contactussaver/index', ['enquiry_id' => $enquiryId]);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('There was a problem deleting the enquiry'));
                return $resultRedirect->setPath('contactussaver/index', ['enquiry_id' => $enquiryId]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find the enquiry to delete.'));
        $resultRedirect->setPath('contactussaver/index');
        return $resultRedirect;
    }
}
