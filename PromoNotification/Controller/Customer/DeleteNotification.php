<?php
namespace Magenest\PromoNotification\Controller\Customer;

use Magento\Framework\Controller\ResultFactory;

class DeleteNotification extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerID = $customerSession->getId();
        $customer = $objectManager->create('Magento\Customer\Model\Customer')->load($customerID);

        $notification_received = explode(',',$customer->getDataByKey('notification_received'));
        for($i = 0 ; $i < count($notification_received) ; $i++)
        {
            if($notification_received[$i] == $entity_id)
                unset($notification_received[$i]);
        }

        $receive = implode(',',$notification_received);

        $customer->setData('notification_received',$receive);
        $customer->save();
    }
}

