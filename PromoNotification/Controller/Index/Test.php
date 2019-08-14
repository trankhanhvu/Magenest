<?php
namespace Magenest\PromoNotification\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $notification = $objectManager->create('Magento\Customer\Model\ResourceModel\Customer\Collection');

        $output = '';
        foreach ($notification as $product) {
            $test = $product->getGender();
            $output .= \Zend_Debug::dump($product->debug(), null,
                false);
        }
        $this->getResponse()->setBody($output);
    }
}