<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeRating implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $id = $observer->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $movie = $objectManager->create('Magenest\Movie\Model\Movie')->load($id);
        $movie->setRating(0);
        $movie->save();
    }
}