<?php

namespace Magenest\Cybergame\Block\Form;

class Edit extends \Magento\Customer\Block\Form\Edit
{
    public function checkCyberManager()
    {
        $is_manager = $this->customerSession->getCustomer()->getDataByKey('is_manager');
        return $is_manager;
    }
}