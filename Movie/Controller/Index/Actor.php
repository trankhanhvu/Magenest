<?php
namespace Magenest\Movie\Controller\Index;
class Actor extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $subscription = $this->_objectManager->create('Magenest\Movie\Model\Movie');
        $subscription->setName('Pokemon');
        $subscription->setDirector_id('1');
        $subscription->save();
        $this->getResponse()->setBody('success');
        //tau l
    }
}