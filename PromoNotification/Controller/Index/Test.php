<?php
namespace Magenest\PromoNotification\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $notification = $objectManager->create('Magenest\PromoNotification\Model\ResourceModel\Notification\Collection');

        $output = '';
        foreach ($notification as $product) {
            $output .= \Zend_Debug::dump($product->debug(), null,
                false);
        }
        $this->getResponse()->setBody($output);
    }
}