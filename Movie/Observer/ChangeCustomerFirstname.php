<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeCustomerFirstname implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $id = $observer->getCustomer()->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customer = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $customer->setFirstname('Magenest');
        $customer->save();
    }
}