<?php
namespace Magenest\PromoNotification\Controller\Customer;

use Magento\Framework\Controller\ResultFactory;

class Markasview extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getId();
        $customer = $objectManager->create('Magento\Customer\Model\Customer')->load($customerID);

        $notification_viewed = $customer->getDataByKey('notification_viewed');
        if($notification_viewed == "")
            $notification_viewed = $entity_id;
        else
            $notification_viewed = $notification_viewed . "," . $entity_id;

        $customer->setData('notification_viewed',$notification_viewed);
        $customer->save();
    }
}

