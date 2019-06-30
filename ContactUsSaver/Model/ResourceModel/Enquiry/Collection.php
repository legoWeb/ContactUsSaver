<?php
// @codingStandardsIgnoreFile

namespace Polushkin\ContactUsSaver\Model\ResourceModel\Enquiry;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'enquiry_id';

    /**
     * Collection initialisation
     */
    protected function _construct()
    {
        $this->_init(
            'Polushkin\ContactUsSaver\Model\Enquiry',
            'Polushkin\ContactUsSaver\Model\ResourceModel\Enquiry'
        );
    }
}
