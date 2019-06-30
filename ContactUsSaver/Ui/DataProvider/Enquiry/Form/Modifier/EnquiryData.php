<?php

namespace Polushkin\ContactUsSaver\Ui\DataProvider\Enquiry\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Polushkin\ContactUsSaver\Model\ResourceModel\Enquiry\CollectionFactory;

class EnquiryData implements ModifierInterface
{
    /**
     * @var \Polushkin\ContactUsSaver\Model\ResourceModel\Enquiry\Collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $enquiryCollectionFactory
     */
    public function __construct(
        CollectionFactory $enquiryCollectionFactory
    ) {
        $this->collection = $enquiryCollectionFactory->create();
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    /**
     * @param array $data
     * @return array|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function modifyData(array $data)
    {
        $items = $this->collection->getItems();
        /** @var $enquiry \Polushkin\ContactUsSaver\Model\Enquiry */
        foreach ($items as $enquiry) {
            $_data = $enquiry->getData();
            $enquiry->setData($_data);
            $data[$enquiry->getId()] = $_data;
        }
        return $data;
    }
}
