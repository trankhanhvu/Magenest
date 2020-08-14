<?php

namespace Magenest\Frontend\Block\Frontend;
use Magento\Framework\View\Element\Template;

class AccountInfo extends Template
{
    public function getCustomerId()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');

        $id = $customerSession->getId();
        return $id;
    }

    public function getCustomerFirstName()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $id = $this->getCustomerId();
        $customerinfo = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $firstname = $customerinfo->getFirstname();

        return $firstname;
    }

    public function getCustomerLastName()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $id = $this->getCustomerId();
        $customerinfo = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $lastname = $customerinfo->getLastname();

        return $lastname;
    }
}