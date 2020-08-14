<?php

namespace Magenest\Movie\Block\Adminhtml\Movie\Rating;

use Magento\Framework\View\Element\Template;

class Star extends Template
{
    public function getRating()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('Magento\Framework\App\Request\Http');
        $id = $request->getParam('id');

        $movie =$objectManager->create('Magenest\Movie\Model\Movie')->load($id);

        $rating = $movie->getRating();

        return $rating;
    }
}