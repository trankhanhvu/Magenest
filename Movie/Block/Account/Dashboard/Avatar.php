<?php

namespace Magenest\Movie\Block\Account\Dashboard;
use Magento\Framework\View\Element\Template;

class Avatar extends Template
{
    public function getImageCustomer()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerSession->getMyValue();

        $id = $_SESSION['default']['visitor_data']['customer_id'];
        $customerinfo = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
        $image = $customerinfo->getCustomer_avatar();

        return $image;
    }
}