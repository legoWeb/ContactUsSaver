<?php

namespace Polushkin\ContactUsSaver\Controller\Adminhtml\Index;

use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Polushkin\ContactUsSaver\Controller\Adminhtml\ContactUsSaver;

class Save extends ContactUsSaver
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Polushkin\ContactUsSaver\Model\EnquiryFactory
     */
    private $enquiryFactory;


    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Polushkin\ContactUsSaver\Model\EnquiryFactory $enquiryFactory
     * @param \Polushkin\ContactUsSaver\Api\EnquiryRepositoryInterface $enquiryRepository
     * @param $resultPageFactory
     * @param $resultForwardFactory
     * @param $registry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Polushkin\ContactUsSaver\Model\EnquiryFactory $enquiryFactory,
        \Polushkin\ContactUsSaver\Api\EnquiryRepositoryInterface $enquiryRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Registry $registry
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->enquiryFactory = $enquiryFactory;
        parent::__construct($registry, $enquiryRepository, $resultPageFactory, $resultForwardFactory, $context);

    }
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (empty($data['created_at'])) {
                $data['created_at'] = (date('Y-m-d H:m:s'));
            } else {
                $data['created_at'] = (date('Y-m-d H:m:s'));
                $data['updated_at'] = (date('Y-m-d H:m:s'));
            }

            if (empty($data['enquiry_id'])) {
                $data['enquiry_id'] = null;
            }

            /** @var \Polushkin\ContactUsSaver\Model\Enquiry $model */
            $model = $this->enquiryFactory->create();

            $id = $this->getRequest()->getParam('enquiry_id');
            if ($id) {
                try {
                    $model = $this->enquiryRepository->getById($id);
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This Contact no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->enquiryRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Contact.'));
                $this->dataPersistor->clear('enquiry');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['enquiry_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Contact.'));
            }

            $this->dataPersistor->set('polushkin_contactussaver_enquiries', $data);
            return $resultRedirect->setPath('*/*/edit', ['enquiry_id' => $this->getRequest()->getParam('enquire_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
