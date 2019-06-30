<?php

namespace Polushkin\ContactUsSaver\Block\Adminhtml\Enquiry\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save extends Generic implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getEnquiryId()) {
            $data = [
                'label' => __('Answer'),
                'class' => 'save',
                'on_click' => 'saveConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getSaveUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', ['enquiry_id' => $this->getEnquiryId()]);
    }
}
