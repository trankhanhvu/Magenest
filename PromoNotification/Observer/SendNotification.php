<?php

namespace Magenest\PromoNotification\Observer;

use Magento\Framework\Event\ObserverInterface;

class SendNotification implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $idnoti = $observer->getIdnoti();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customer = $objectManager->create('Magento\Customer\Model\ResourceModel\Customer\Collection')
            ->addAttributeToSelect('*');

        foreach ($customer as $c)
        {
            $value = $c->getData('notification_received');

            if($value == null)
            {
                $c->setData('notification_received',$idnoti);
                $c->save();
            }
            else
            {
                $value = $value . "," . $idnoti;
                $c->setData('notification_received',$value);
                $c->save();
            }


        }
    }
}